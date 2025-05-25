<?php

namespace App\Actions\Student;

use App\Models\Grup;
use App\Models\Student;
use App\Models\SubGrup;
use App\Models\Specialtie;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentLifeSkillScore;

class ImportStudentsFromExcel
{
    use WithFileUploads;

    public array $duplicate_students = [];

    public function store_students($excel)
    {
        $filePath = $excel->getRealPath();
        $importedData = Excel::toCollection(null, $filePath)->first();

        $expectedHeader = [
            'Primer Apellido',
            'Segundo Apellido',
            'Nombre',
            'Número de Cédula',
            'Nivel',
            'Sección',
            'Especialidad'
        ];

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $actualHeader = $importedData->first()->toArray();

        if (array_slice($actualHeader, 0, count($expectedHeader)) !== $expectedHeader) {
            return [
                'status' => 2,
                'message' => 'Error, el Excel no cuenta con el formato requerido.',
                'duplicates' => [],
            ];
        }

        $levelsAllowed = ['Décimo', 'Undécimo', 'Duodécimo'];
        $levelMap = ['Décimo' => 1, 'Undécimo' => 2, 'Duodécimo' => 3];

        $existingIdCards = array_flip(Student::pluck('id_card')->toArray());

        DB::beginTransaction();

        try {
            foreach ($importedData->skip(1) as $row) {
                $level = trim($row[4] ?? '');
                if (!in_array($level, $levelsAllowed)) {
                    continue;
                }

                $level_id = $levelMap[$level];
                $fullName = trim($row[2] ?? '');
                $names = explode(' ', $fullName, 2);
                $first_name  = $names[0] ?? '';
                $middle_name = $names[1] ?? '';
                $last_name1 = trim($row[0] ?? '');
                $last_name2 = trim($row[1] ?? '');
                $id_card = trim($row[3] ?? '');
                $specialtieName = trim($row[6] ?? '');
                $grup = trim($row[5] ?? '');

                if (isset($existingIdCards[$id_card])) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'level' => $level,
                        'grup' => $grup,
                        'reason'      => 'Ya existe en el sistema. Si deseas actualizar su información, deberas de hacerlo manualmente.',
                    ];
                    continue;
                }

                if (strtolower($specialtieName) === 'Sin especialidad') {
                    continue;
                }

                $specialtieSlug = $this->stringToSlug($specialtieName);
                $specialtie_id = Specialtie::select('id')->where('slug', $specialtieSlug)->first();

                if (!$specialtie_id) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'level' => $level,
                        'grup' => $grup,
                        'reason'      => 'Especialidad no encontrada, deberas de insertar este estudiante de forma manual.',
                    ];
                    continue;
                }

                $grup_id = Grup::select('id')->where('level_id', $level_id)->where('name', $grup)->first();
                if (!$grup_id) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'level' => $level,
                        'grup' => $grup,
                        'reason'      => 'El grupo no se encuentra en los registros, debes de crear el grupo de primero para registrar al estudiante.',
                    ];
                    continue;
                }

                $subGrup_id = SubGrup::select('id')->where('grup_id', $grup_id->id)->where('specialtie_id', $specialtie_id->id)->first();

                if (!$subGrup_id) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'level' => $level,
                        'grup' => $grup,
                        'reason'      => 'La especialidad del estudiante no coincide con las especialidades asociadas al grupo.',
                    ];
                    continue;
                }

                $student = Student::create([
                    'sub_grup_id'  => $subGrup_id->id,
                    'first_name'   => $first_name,
                    'middle_name'  => $middle_name,
                    'last_name1'   => $last_name1,
                    'last_name2'   => $last_name2,
                    'id_card'      => $id_card,
                ]);

                StudentLifeSkillScore::create([
                    'student_id' => $student->id,
                    'score' => 100
                ]);
            }

            DB::commit();

            return [
                'status' => !empty($this->duplicate_students) ? 3 : 1,
                'message' => !empty($this->duplicate_students)
                    ? 'Algunos estudiantes no se importaron.'
                    : 'Todos los estudiantes fueron registrados correctamente.',
                'duplicates' => $this->duplicate_students,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 2,
                'message' => 'Error: ' . $e->getMessage(),
                'duplicates' => [],
            ];
        }
    }

    public function store_grup_of_students($excel, $grup_id)
    {
        $filePath = $excel->getRealPath();
        $importedData = Excel::toCollection(null, $filePath)->first();

        $expectedHeader = [
            'primer-apellido',
            'segundo-apellido',
            'nombre',
            'numero-de-cedula',
            'especialidad'
        ];

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $actualHeaderRaw = $importedData->first()->toArray();

        $actualHeader = array_map([$this, 'stringToSlug'], array_slice($actualHeaderRaw, 0, count($expectedHeader)));

        if ($actualHeader !== $expectedHeader) {
            return [
                'status' => 2,
                'message' => 'Error, el Excel no cuenta con el formato requerido.',
                'duplicates' => [],
            ];
        }

        $existingIdCards = array_flip(Student::pluck('id_card')->toArray());

        DB::beginTransaction();

        try {
            foreach ($importedData->skip(1) as $row) {

                $fullName = trim($row[2] ?? '');
                $names = explode(' ', $fullName, 2);
                $first_name  = $names[0] ?? '';
                $middle_name = $names[1] ?? '';
                $last_name1 = trim($row[0] ?? '');
                $last_name2 = trim($row[1] ?? '');
                $id_card = trim($row[3] ?? '');
                $specialtieName = trim($row[4] ?? '');

                if (isset($existingIdCards[$id_card])) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'reason'      => 'Ya existe en el sistema. Si deseas actualizar su información, deberas de hacerlo manualmente.',
                    ];
                    continue;
                }

                $specialtieSlug = $this->stringToSlug($specialtieName);
                $specialtie_id = Specialtie::select('id')->where('slug', $specialtieSlug)->first();

                if (!$specialtie_id) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'reason'      => 'Especialidad no encontrada, deberas de insertar este estudiante de forma manual.',
                    ];
                    continue;
                }

                $subGrup_id = SubGrup::select('id')->where('grup_id', $grup_id)->where('specialtie_id', $specialtie_id->id)->first();

                if (!$subGrup_id) {
                    $this->duplicate_students[] = [
                        'id_card'     => $id_card,
                        'first_name'  => $first_name,
                        'middle_name' => $middle_name,
                        'last_name1'  => $last_name1,
                        'last_name2'  => $last_name2,
                        'specialtie' => $specialtieName,
                        'reason'      => 'La especialidad del estudiante no coincide con las especialidades asociadas al grupo.',
                    ];
                    continue;
                }

                $student = Student::create([
                    'sub_grup_id'  => $subGrup_id->id,
                    'first_name'   => $first_name,
                    'middle_name'  => $middle_name,
                    'last_name1'   => $last_name1,
                    'last_name2'   => $last_name2,
                    'id_card'      => $id_card,
                ]);

                StudentLifeSkillScore::create([
                    'student_id' => $student->id,
                    'score' => 100
                ]);
            }

            DB::commit();

            return [
                'status' => !empty($this->duplicate_students) ? 3 : 1,
                'message' => !empty($this->duplicate_students)
                    ? 'Algunos estudiantes no se importaron.'
                    : 'Todos los estudiantes fueron registrados correctamente.',
                'duplicates' => $this->duplicate_students,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 2,
                'message' => 'Error: ' . $e->getMessage(),
                'duplicates' => [],
            ];
        }
    }

    private function stringToSlug(string $str): string
    {
        $str = trim($str);
        $str = mb_strtolower($str, 'UTF-8');
        $from = [
            'à',
            'á',
            'ä',
            'â',
            'è',
            'é',
            'ë',
            'ê',
            'ì',
            'í',
            'ï',
            'î',
            'ò',
            'ó',
            'ö',
            'ô',
            'ù',
            'ú',
            'ü',
            'û',
            'ñ',
            'ç',
            '·',
            '/',
            '_',
            ',',
            ':',
            ';'
        ];
        $to   = [
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'n',
            'c',
            '-',
            '-',
            '-',
            '-',
            '-',
            '-'
        ];
        $str = str_replace($from, $to, $str);
        $str = preg_replace('/[^a-z0-9 -]/', '', $str);
        $str = preg_replace('/\s+/', '-', $str);
        $str = preg_replace('/-+/', '-', $str);
        return $str;
    }
}
