<?php

namespace App\Livewire\Pages\Subjects\SubjectsXTeachers;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SubjectsTaughtByTeachers;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;
    
    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = '';
    public ?SubjectsTaughtByTeachers $subjects_taught_by_teachers = null;

    public function subjectsXteachers(): LengthAwarePaginator
    {
        $subjectsXteachers = SubjectsTaughtByTeachers::with([
            'teacher:id,first_name,middle_name,last_name1,last_name2',
            'subGrup:id,name,grup_id',
            'subGrup.grup:id,name,level_id',
            'subGrup.grup.level:id,name',
            'subject:id,name',
        ])->when($this->search, function ($query) {
            $query
                ->orWhereHas('subject', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                })
                ->orWhereHas('subGrup.grup.level', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                })
                ->orWhereHas('teacher', function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('middle_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%");
                })
                ->orWhereHas('subject.specialtie', function ($q) {
                    $q->where('acronym', 'like', "%{$this->search}%");
                });
        })->get();

        $subjects = $subjectsXteachers->sortBy(function ($item) {
            $column = $this->sortBy['column'];
            return match ($column) {
                'subject.name' => optional($item->specialtie)->name,
                'teacher.first_name' => optional($item->teacher)->first_name,
                'teacher.last_name1' => optional($item->teacher)->last_name1,
                'subGrup.name' => optional($item->subGrup)->name,
                'subGrup.grup.name' => optional($item->subGrup?->grup)->name,
                'subGrup.grup.level.name' => optional($item->subGrup?->grup?->level)->name,
                default => $item->{$column},
            };
        }, options: SORT_REGULAR);

        if ($this->sortBy['direction'] === 'desc') {
            $subjects = $subjects->reverse();
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginated = $subjects->slice(($currentPage - 1) * $this->perPage, $this->perPage)->values();

        return new LengthAwarePaginator($paginated, $subjects->count(), $this->perPage, $currentPage);
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
        $this->subjects_taught_by_teachers = null;
        $this->success(__('Eliminado exitosamente!'));
    }

    public function render()
    {
        $heders = [
            ['key' => 'subject', 'label' => __('Materia')],
            ['key' => 'level', 'label' => __('Nivel')],
            ['key' => 'grup', 'label' => __('Grupo')],
            ['key' => 'teacher', 'label' => __('Profesor')],
        ];

        return view('livewire.pages.subjects.subjects-x-teachers.index', [
            'headers' => $heders,
            'subjectsXteachers' => $this->subjectsXteachers(),
        ]);
    }
}
