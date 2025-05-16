<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLifeSkillScore extends Model
{
    protected $table = 'student_life_skill_scores';

    protected $fillable = [
        'student_id',
        'score'
    ];

    protected $casts = [
        'score' => 'float',
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
