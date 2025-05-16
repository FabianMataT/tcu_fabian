<?php

namespace App\Livewire\Pages\TeacherLifeSkillsToAssess\StudentToAssessLifeSkill;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentToAssessLifeSkill;
use App\Models\TeacherLifeSkillsToAsses;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    use WithPagination, Toast;

    public ?TeacherLifeSkillsToAsses $gruptoassess = null;
    public ?StudentToAssessLifeSkill $student = null;
    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'student_last_name1', 'direction' => 'asc'];
    public string $search = '';

    public function studentToAssessLifeSkills(): LengthAwarePaginator
    {
        return StudentToAssessLifeSkill::query()
            ->withAggregate('student', 'first_name')
            ->withAggregate('student', 'middle_name')
            ->withAggregate('student', 'last_name1')
            ->withAggregate('student', 'last_name2')
            ->withAggregate('student', 'id_card')
            ->where('teacher_life_skills_to_assess_id', $this->gruptoassess->id)
            ->when(
                $this->search,
                fn($q) => $q->whereHas(
                    'student',
                    fn($s) =>
                    $s->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('middle_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('id_card', 'like', "%{$this->search}%")
                )
            )
            ->orderBy(...array_values($this->sortBy))
            ->paginate($this->perPage);
    }

    public function deleteConf(StudentToAssessLifeSkill $student): void 
    {
        $this->student = $student;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->student === null) {
            $this->error("No hay ningun estudiante seleccionado.");
            return;
        }
        $this->student->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->student = null;
    }

    public function render()
    {
        $headers = [
            ['key' => 'student_id_card', 'label' => __('Cédula')],
            ['key' => 'student_last_name1', 'label' => __('1º Apellido')],
            ['key' => 'student_last_name2', 'label' => __('2º Apellido')],
            ['key' => 'student_first_name', 'label' => __('Nombre')],
        ];

        return view('livewire.pages.teacher-life-skills-to-assess.student-to-assess-life-skill.show', [
            'headers' => $headers,
            'studentToAssessLifeSkills' => $this->studentToAssessLifeSkills()
        ]);
    }
}
