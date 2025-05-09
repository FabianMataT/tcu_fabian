<?php

namespace App\Livewire\Pages\Grups;

use App\Models\Grup;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;
use App\Models\Specialtie;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Actions\Student\ImportStudentsFromExcel;

class Show extends Component
{
    use WithPagination, Toast, WithFileUploads;

    public bool $modalDeletConf, $modalStudentsFormExcel = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id_card', 'direction' => 'asc'];
    public string $search = '';
    public ?Grup $grup = null;
    public ?Student $student = null;
    public $excel, $message;
    public array $duplicate_students = [];
    public int $masiveInsert = 0;

    public function students(): LengthAwarePaginator
    {
        $query = Student::with([
            'subGrup:id,grup_id,specialtie_id,name',
            'subGrup.specialtie:id,acronym'
        ])->whereHas('subGrup', fn($q) => $q->where('grup_id', $this->grup->id))
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
    
    public function render()
    {
        $headers = [
            ['key' => 'id_card', 'label' => __('Cédula')],
            ['key' => 'last_name1', 'label' => __('1º Apellido')],
            ['key' => 'last_name2', 'label' => __('2º Apellido')],
            ['key' => 'name', 'label' => __('Nombre')],
            ['key' => 'subgrup', 'label' => __('Subgrupo')],
            ['key' => 'specialtie', 'label' => __('Especialidad')],
        ];

        return view('livewire.pages.grups.show', [
            'headers' => $headers,
            'students' => $this->students(),
        ]);
    }
}
