<?php

namespace App\Livewire\Pages\Students;

use App\Models\Grup;
use App\Models\User;
use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;
use App\Models\Specialtie;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Actions\Student\ImportStudentsFromExcel;

class Index extends Component
{
    use WithPagination, Toast, WithFileUploads;

    public bool $modalDeletConf, $modalFilters, $modalStudentsFormExcel = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id_card', 'direction' => 'asc'];
    public string $search = '';
    public ?Student $student = null;
    public ?User $user = null;
    public ?Collection  $specialties, $levels, $grups, $subGrups = null;
    public $excel, $message;
    public array $duplicate_students = [];

    public ?string $first_name = null;
    public ?string $middle_name = null;
    public ?string $last_name1 = null;
    public ?string $last_name2 = null;
    public ?string $id_card = null;

    public ?int $specialtie_id = null;
    public ?int $level_id = null;
    public ?int $grup_id = null;
    public ?int $sub_grup_id = null;
    public ?float $min_life_skill_score = null;
    public ?float $max_life_skill_score = null;
    public ?int $filtersOptionsLoaded = null;
    public int $masiveInsert = 0;


    public function mount()
    {
        $this->user = Auth::user();
        $this->filtersOptionsLoaded = 0;
        $this->specialties = collect();
        $this->levels = collect();
        $this->grups = collect();
        $this->subGrups = collect();
    }

    public function students(): LengthAwarePaginator
    {
        $query = Student::query()
            ->withAggregate('studentLifeSkillScore', 'score')
            ->with([
                'subGrup:id,grup_id,specialtie_id,name',
                'subGrup.specialtie:id,acronym',
                'subGrup.grup.level:id,name',
            ])
            ->when(
                $this->user?->teacher?->first_name,
                fn($q) => $q->whereHas('subGrup.subjects_taught_by_teacher', function ($query) {
                    $query->where('teacher_id', $this->user->teacher->id);
                })
            )
            ->when($this->first_name, fn($q) => $q->where('first_name', 'like', "%{$this->first_name}%"))
            ->when($this->middle_name, fn($q) => $q->where('middle_name', 'like', "%{$this->middle_name}%"))
            ->when($this->last_name1, fn($q) => $q->where('last_name1', 'like', "%{$this->last_name1}%"))
            ->when($this->last_name2, fn($q) => $q->where('last_name2', 'like', "%{$this->last_name2}%"))
            ->when($this->id_card, fn($q) => $q->where('id_card', 'like', "%{$this->id_card}%"))
            ->when($this->specialtie_id, fn($q) => $q->whereHas('subGrup.specialtie', fn($q2) => $q2->where('id', $this->specialtie_id)))
            ->when($this->level_id, fn($q) => $q->whereHas('subGrup.grup.level', fn($q2) => $q2->where('id', $this->level_id)))
            ->when($this->grup_id, fn($q) => $q->whereHas('subGrup.grup', fn($q2) => $q2->where('id', $this->grup_id)))
            ->when($this->sub_grup_id, fn($q) => $q->where('sub_grup_id', $this->sub_grup_id))
            ->when($this->min_life_skill_score !== null, fn($q) => $q->having('student_life_skill_score_score', '>=', $this->min_life_skill_score))
            ->when($this->max_life_skill_score !== null, fn($q) => $q->having('student_life_skill_score_score', '<=', $this->max_life_skill_score))
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('id_card', 'like', "%{$this->search}%")
                        ->orWhereHas('subGrup.grup.level', fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                        ->orWhereHas('subGrup.specialtie', fn($q) => $q->where('acronym', 'like', "%{$this->search}%"));
                });
            });

        $sortColumn = $this->sortBy['column'];
        $sortDirection = $this->sortBy['direction'];

        switch ($sortColumn) {
            case 'level':
                $query->join('sub_grups', 'students.sub_grup_id', '=', 'sub_grups.id')
                    ->join('grups', 'sub_grups.grup_id', '=', 'grups.id')
                    ->join('levels', 'grups.level_id', '=', 'levels.id')
                    ->orderBy('levels.name', $sortDirection)
                    ->select('students.*');
                break;
            case 'student_life_skill_score_score':
                $query->orderBy('student_life_skill_score_score', $sortDirection);
                break;
            case 'first_name':
            case 'last_name1':
            case 'last_name2':
            case 'id_card':
                $query->orderBy($sortColumn, $sortDirection);
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

    public function clearFilters()
    {
        $this->reset([
            'first_name',
            'middle_name',
            'last_name1',
            'last_name2',
            'id_card',
            'min_life_skill_score',
            'max_life_skill_score',
            'specialtie_id',
            'level_id',
            'grup_id',
            'sub_grup_id',
            'search',
        ]);

        $this->resetPage();
        $this->modalFilters = false;
    }

    public function loadFilters()
    {
        if ($this->filtersOptionsLoaded == 0) {
            $this->filtersOptionsLoaded = 1;
            $this->specialties = Specialtie::select('id', 'acronym')->get();
            $this->levels = Level::select('id', 'name')->get();
            $this->loadGrups();
            $this->loadSubGrups();
        }
    }

    public function loadGrups()
    {
        $this->grups = Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
        return $this->grups;
    }

    public function loadSubGrups()
    {
        $this->subGrups = SubGrup::with('specialtie:id,acronym')
            ->select('id', 'specialtie_id', 'grup_id', 'name')
            ->where('grup_id', $this->grup_id)
            ->get()
            ->map(function ($subGrup) {
                $subGrup->name = $subGrup->name . ' - ' . ($subGrup->specialtie->acronym ?? '');
                return $subGrup;
            });
        return $this->subGrups;
    }

    // Store all the students coming from the excel
    public function store()
    {
        $this->validate([
            'excel' => 'required|file|mimes:xls,xlsx',
        ]);

        $importer = new ImportStudentsFromExcel();
        $result = $importer->store_students($this->excel);

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
            ['key' => 'level', 'label' => __('Nivel')],
            ['key' => 'grup', 'label' => __('Sección'), 'sortable' => false],
            ['key' => 'specialtie', 'label' => __('Especialidad'), 'sortable' => false],
            ['key' => 'student_life_skill_score_score', 'label' => __('Calificación')]
        ];

        return view('livewire.pages.students.index', [
            'headers' => $headers,
            'students' => $this->students(),
        ]);
    }
}
