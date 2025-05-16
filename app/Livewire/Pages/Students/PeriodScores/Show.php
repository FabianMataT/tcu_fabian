<?php

namespace App\Livewire\Pages\Students\PeriodScores;

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentLifeSkillPeriodScore;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\StudentLifeSkillSubjectPeriodScore;

class Show extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public ?StudentLifeSkillPeriodScore $studentperiodscore = null;
    public ?StudentLifeSkillSubjectPeriodScore $subjectPeriodScore = null;
    public ?User $user = null;
    public $perPage = 10;

    public function mount(){
        $this->user = Auth::user();
    }

    public function subjectPeriodScores(): LengthAwarePaginator
    {
        $query = StudentLifeSkillSubjectPeriodScore::query()
            ->with(['subject:id,name', 'teacher:id,first_name,middle_name,last_name1,last_name2'])
            ->when(
                $this->user?->teacher?->first_name,
                fn($q) => $q->whereHas('teacher', function ($query) {
                    $query->where('id', $this->user->teacher->id);
                })
            )
            ->where('student_life_skill_period_score_id', $this->studentperiodscore->id)
            ->select('id', 'subject_id', 'teacher_id', 'score', 'total_points', 'earned_points')
            ->orderBy('id', 'asc');

        return $query->paginate($this->perPage);
    }

    public function deleteConf(StudentLifeSkillSubjectPeriodScore $subjectPeriodScore): void
    {
        $this->subjectPeriodScore = $subjectPeriodScore;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->subjectPeriodScore === null) {
            $this->error("No hay ninguna evaluación seleccionada.");
            return;
        }
        $this->subjectPeriodScore->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->subjectPeriodScore = null;
    }

    public function render()
    {
        return view('livewire.pages.students.period-scores.show', [
            'subjectPeriodScores' => $this->subjectPeriodScores()
        ]);
    }
}
