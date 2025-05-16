<?php

namespace App\Livewire\Pages\Grups;

use App\Models\Grup;
use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;
use App\Models\Specialtie;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Actions\Student\ImportStudentsFromExcel;

class Show extends Component
{
    use WithPagination, Toast, WithFileUploads;

    public bool $modalDeletConf, $modalStudentsFormExcel, $modalChangeSubgrups = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id_card', 'direction' => 'asc'];
    public string $search = '';
    public ?Grup $grup = null;
    public ?Student $student = null;
    public $excel, $message;
    public array $duplicate_students = [];
    public int $masiveInsert = 0;
    public int $changeSubgrups = 0;
    public int $subgrup_id, $level_id, $grup_id;
    public string $subgrup_name;
    public ?Collection $subgrups, $levels, $grups = null;

    public function mount()
    {
        $this->subgrups = collect();
        $this->levels = collect();
        $this->grups = collect();
    }

    public function students(): LengthAwarePaginator
    {
        $query = Student::with([
            'subGrup:id,grup_id,specialtie_id,name',
            'subGrup.specialtie:id,acronym'
        ])
            ->withAggregate('studentLifeSkillScore', 'score')
            ->whereHas('subGrup', fn($q) => $q->where('grup_id', $this->grup->id))
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('id_card', 'like', "%{$this->search}%")
                        ->orWhereHas('subGrup.specialtie', fn($q) => $q->where('acronym', 'like', "%{$this->search}%"));
                });
            });

        $sortColumn = $this->sortBy['column'];
        $sortDirection = $this->sortBy['direction'];

        switch ($sortColumn) {
            case 'subgrup':
                $query->orderBy(
                    SubGrup::select('name')
                        ->whereColumn('id', 'students.sub_grup_id')
                        ->limit(1),
                    $sortDirection
                );
                break;
            case 'specialtie':
                $query->orderBy(
                    Specialtie::select('acronym')
                        ->join('sub_grups', 'specialties.id', '=', 'sub_grups.specialtie_id')
                        ->whereColumn('sub_grups.id', 'students.sub_grup_id')
                        ->limit(1),
                    $sortDirection
                );
                break;
            case 'student_life_skill_score_score':
                $query->orderBy('student_life_skill_score_score', $sortDirection);
                break;
            case 'id_card':
            case 'name':
            case 'last_name1':
            case 'last_name2':
                $column = $sortColumn === 'name' ? 'first_name' : $sortColumn;
                $query->orderBy($column, $sortDirection);
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }
        return $query->paginate($this->perPage);
    }

    public function deleteConf(Student $student): void
    {
        $this->student = $student;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->student === null) {
            $this->error("No hay ningun estudiante seleccionada.");
            return;
        }
        $this->student->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->student = null;
    }

    // Store in the current group all the students coming from the excel
    public function store()
    {
        $this->validate([
            'excel' => 'required|file|mimes:xls,xlsx',
        ]);

        $importer = new ImportStudentsFromExcel();
        $result = $importer->store_grup_of_students($this->excel, $this->grup->id);

        $this->masiveInsert = $result['status'];
        $this->message = $result['message'];
        $this->duplicate_students = $result['duplicates'] ?? [];

        $this->excel = null;
        $this->modalStudentsFormExcel = false;
    }

    public function closeModal()
    {
        $this->message = '';
        $this->duplicate_students = [];
        $this->masiveInsert = 0;
    }

    // Moves a student subgroup to a different group and renames it to "A" or "B".
    // If a subgroup with that name already exists in the target group, it is renamed to "Antiguo-A" or "Antiguo-B".
    // If a subgroup with the "Old" name already exists, the process is halted to avoid duplicates.
    public function update()
    {
        $this->validate([
            'subgrup_id' => 'required|exists:sub_grups,id',
            'level_id' => 'nullable|exists:levels,id',
            'grup_id' => 'required|exists:grups,id',
            'subgrup_name' => 'required|string|in:A,B',
        ]);

        $subgrup_to_change = SubGrup::find($this->subgrup_id);
        $existing_subgrup = SubGrup::where('grup_id', $this->grup_id)->where('name', $this->subgrup_name)->first();

        $antiguo_name = $this->subgrup_name . '-Antiguo';
        $antiguo_exists = SubGrup::where('grup_id', $this->grup_id)->where('name', $antiguo_name)->exists();

        if ($antiguo_exists) {
            $this->masiveInsert = 2;
            $this->message = "Ya existe un subgrupo ({$this->subgrup_name}) y un subgrupo ({$antiguo_name}) en el grupo de destino. Para poder trasladar a los estudiantes, primero debes mover el subgrupo ({$antiguo_name}) a otro grupo. Luego podrás completar el traslado intentándolo nuevamente.";
            $this->modalChangeSubgrups = false;
            return true;
        }

        if ($existing_subgrup) {
            $existing_subgrup->name = $antiguo_name;
            $existing_subgrup->save();
        }

        $subgrup_to_change->grup_id = $this->grup_id;
        $subgrup_to_change->name = $this->subgrup_name;
        $subgrup_to_change->save();

        $this->subgrup_id = 0;
        $this->grup_id = 0;
        $this->level_id = 0;
        $this->masiveInsert = 1;
        $this->message = "Los estudiantes del subgrupo ({$this->subgrup_name}) han sido transladados de forma exitosa";
        $this->modalChangeSubgrups = false;
    }

    public function ChangeSubgrups()
    {
        if ($this->changeSubgrups == 0) {
            $this->levels = Level::select('id', 'name')->get();
            $this->subgrups = SubGrup::with('specialtie:id,acronym')
                ->select('id', 'specialtie_id', 'grup_id', 'name')
                ->where('grup_id', $this->grup->id)
                ->get()
                ->map(function ($subgrups) {
                    $subgrups->name = $subgrups->name . ' - ' . ($subgrups->specialtie->acronym ?? '');
                    return $subgrups;
                });
        } else {
            dd('ya se cargo, relax');
        }
    }

    public function loadGrups()
    {
        $this->grups = Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
        return $this->grups;
    }

    public function render()
    {
        $headers = [
            ['key' => 'id_card', 'label' => __('Cédula')],
            ['key' => 'last_name1', 'label' => __('1º Apellido')],
            ['key' => 'last_name2', 'label' => __('2º Apellido')],
            ['key' => 'name', 'label' => __('Nombre')],
            ['key' => 'subgrup', 'label' => __('Subgrupo')],
            ['key' => 'specialtie', 'label' => __('Especialidad')],
            ['key' => 'student_life_skill_score_score', 'label' => __('Calificación')]
        ];

        return view('livewire.pages.grups.show', [
            'headers' => $headers,
            'students' => $this->students(),
        ]);
    }
}
