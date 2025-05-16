<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLifeSkillSubjectPeriodScoreDetail extends Model
{
    protected $table = 'student_life_skill_subject_period_score_details';

    protected $fillable = [
        'student_life_skill_subject_period_score_id',
        'name',
        'earned_points',
    ];

    public function studentLifeSkillSubjectPeriodScore()
    {
        return $this->belongsTo(StudentLifeSkillSubjectPeriodScore::class, 'student_life_skill_subject_period_score_id');
    }
}
