<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentToAssessLifeSkill extends Model
{
    protected $table = 'students_to_assess_life_skills';

    protected $fillable = [
        'teacher_life_skills_to_assess_id',
        'student_id'
    ];

    public function teacherLifeSkillsToAssess()
    {
        return $this->belongsTo(TeacherLifeSkillsToAsses::class, 'teacher_life_skills_to_assess_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
