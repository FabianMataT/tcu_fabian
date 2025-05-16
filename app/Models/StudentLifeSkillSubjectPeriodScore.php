<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLifeSkillSubjectPeriodScore extends Model
{
    protected $table = 'student_life_skill_subject_period_scores';

    protected $casts = [
        'score' => 'float',
    ];

    protected $fillable = [
        'student_life_skill_period_score_id', 
        'subject_id', 
        'teacher_id', 
        'score', 
        'total_points', 
        'earned_points'
    ];

    public function studentLifeSkillPeriodScore()
    {
        return $this->belongsTo(StudentLifeSkillPeriodScore::class, 'student_life_skill_period_score_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function studentLifeSkillSubjectPeriodScoreDetail()
    {
        return $this->hasMany(StudentLifeSkillSubjectPeriodScoreDetail::class, 'student_life_skill_subject_period_score_id');
    }
}
