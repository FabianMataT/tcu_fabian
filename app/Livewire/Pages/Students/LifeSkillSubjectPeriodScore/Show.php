<?php

namespace App\Livewire\Pages\Students\LifeSkillSubjectPeriodScore;

use Livewire\Component;
use App\Models\StudentLifeSkillSubjectPeriodScore;
use App\Models\StudentLifeSkillSubjectPeriodScoreDetail;

class Show extends Component
{
    public ?StudentLifeSkillSubjectPeriodScore $subjectperiodscore = null;
    public ?string $student_full_name = null;
    public $lifeSkills;

    public function mount()
    {
        $this->lifeSkills = StudentLifeSkillSubjectPeriodScoreDetail::where(
            'student_life_skill_subject_period_score_id',
            $this->subjectperiodscore->id
        )->select('name', 'earned_points')->get();

        $student = $this->subjectperiodscore->StudentLifeSkillPeriodScore->student;
        $this->student_full_name = trim("{$student->first_name} {$student->middle_name} {$student->last_name1} {$student->last_name2}");
    }

    public function render()
    {
        return view('livewire.pages.students.life-skill-subject-period-score.show');
    }
}
