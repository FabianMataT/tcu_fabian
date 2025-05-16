<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLifeSkillPeriodScore extends Model
{
    protected $table = 'student_life_skill_period_scores';

    protected $date = ['created_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'score' => 'float',
    ];

    protected $fillable = [
        'student_id', 
        'level_id', 
        'period',
        'score',
        'created_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function studentLifeSkillSubjectPeriodScore()
    {
        return $this->hasMany(StudentLifeSkillSubjectPeriodScore::class, 'student_life_skill_period_score_id');
    }
    
}
