<?php

namespace App\Livewire\Pages\Subjects;

use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\SubGrup;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectsTaughtByTeachers;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    use WithPagination, Toast;
    
    public ?Subject $subject = null;
    public ?SubjectsTaughtByTeachers $subjects_taught_by_teachers = null;
    public ?int $teacher_searchable_id = null;
    public ?int $level_id = 1;
    public array $subgrups = [];
    public ?int $subgrup_id = null;
    public bool $modalCreate, $modalEdit, $modalDeletConf = false;
    public Collection $teachersSearchable;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = '';

    protected $rules = [
        'teacher_searchable_id' => 'required|exists:teachers,id',
        'level_id' => 'required|exists:levels,id',
        'subgrup_id' => 'required|exists:sub_grups,id',
    ];

    public function mount()
    {
        $this->searchTeachers();
    }

    public function subjectsXteacher(): LengthAwarePaginator
    {
        $subjects = $this->subject
            ->subjects_taught_by_teacher()
            ->with([
                'teacher:id,first_name,middle_name,last_name1,last_name2',
                'subGrup:id,name,grup_id',
                'subGrup.grup:id,name,level_id',
                'subGrup.grup.level:id,name'
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas(
                        'teacher',
                        fn($q) =>
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name1', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name2', 'like', '%' . $this->search . '%')
                    )
                        ->orWhereHas('subGrup', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('subGrup.grup', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('subGrup.grup.level', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'));
                });
            })->get();

        $subjects = match ($this->sortBy['column']) {
            'teacher' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($m) => optional($m->teacher)->name)
                : $subjects->sortByDesc(fn($m) => optional($m->teacher)->name),

            'subgrup' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($m) => optional($m->subGrup)->name)
                : $subjects->sortByDesc(fn($m) => optional($m->subGrup)->name),

            'grup' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($m) => optional($m->subGrup?->grup)->name)
                : $subjects->sortByDesc(fn($m) => optional($m->subGrup?->grup)->name),

            'level' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($m) => optional($m->subGrup?->grup?->level)->name)
                : $subjects->sortByDesc(fn($m) => optional($m->subGrup?->grup?->level)->name),

            default => $subjects,
        };

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $subjects->slice(($currentPage - 1) * $this->perPage)->values();

        return new LengthAwarePaginator($items, $subjects->count(), $this->perPage, $currentPage);
    }

    public function searchTeachers(string $value = '')
    {
        $selectedOption = Teacher::select('id', DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name1, ' ', last_name2) as name"))
            ->where('id', $this->teacher_searchable_id)
            ->get();

        $this->teachersSearchable = Teacher::query()
            ->select('id', DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name1, ' ', last_name2) as name"))
            ->where('first_name', 'like', '%' . $value . '%')
            ->orderBy('first_name')
            ->take(20)
            ->get()
            ->merge($selectedOption);
    }

    public function loadSubgrups()
    {
        $this->subgrups = SubGrup::with('grup:id,name,level_id')
            ->where('specialtie_id', $this->subject->specialtie_id)
            ->whereHas('grup', function ($query) {
                $query->where('level_id', $this->level_id);
            })
            ->get()
            ->map(function ($subgrup) {
                $subgrup->name = "Grupo {$subgrup->grup->name} - {$subgrup->name}";
                return $subgrup;
            })
            ->toArray();

            $this->searchTeachers();
    }

    public function store()
    {
        $this->validate();

        SubjectsTaughtByTeachers::create([
            'teacher_id' => $this->teacher_searchable_id,
            'sub_grup_id' => $this->subgrup_id,
            'subject_id' => $this->subject->id
        ]);

        $this->teacher_searchable_id = null;
        $this->searchTeachers();
        $this->subgrup_id = null;
        $this->modalCreate = false;
        $this->success(__('¡Profesor asignado a la materia exitosamente!'));
    }

    public function edit(SubjectsTaughtByTeachers $subjects_taught_by_teachers)
    {
        $this->subjects_taught_by_teachers = $subjects_taught_by_teachers;
        $this->teacher_searchable_id = $this->subjects_taught_by_teachers->teacher_id;
        $this->level_id = $this->subjects_taught_by_teachers->subGrup->grup->level_id;
        $this->loadSubgrups();
        $this->subgrup_id = $this->subjects_taught_by_teachers->sub_grup_id;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->subjects_taught_by_teachers->update([
            'teacher_id' => $this->teacher_searchable_id,
            'sub_grup_id' => $this->subgrup_id ,
            'subject_id' => $this->subject->id
        ]);

        $this->teacher_searchable_id = null;
        $this->searchTeachers();
        $this->subgrup_id = null;
        $this->modalEdit = false;
        $this->success(__('¡Profesor Actualizado Exitosamnete!'));
    }

    public function deleteConf(SubjectsTaughtByTeachers $subjects_taught_by_teachers): void
    {
        $this->subjects_taught_by_teachers = $subjects_taught_by_teachers;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->subjects_taught_by_teachers === null) {
            $this->error("No hay ningun profesor seleccionado.");
            return;
        }
        $this->subjects_taught_by_teachers->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->subjects_taught_by_teachers = null;
    }

    public function render()
    {
        $headers = [
            ['key' => 'teacher', 'label' => 'Materia'],
            ['key' => 'grup', 'label' => 'Grupo'],
            ['key' => 'subgrup', 'label' => 'Subgrupo'],
            ['key' => 'level', 'label' => 'Nivel'],
        ];

        $levels =  Level::select('id', 'name')->get();

        $this->loadSubgrups();
        
        return view('livewire.pages.subjects.show', [
            'headers' => $headers,
            'subjectsXteacher' => $this->subjectsXteacher(),
            'levels' => $levels,
            'subgrups' => $this->subgrups
        ]);
    }
}
