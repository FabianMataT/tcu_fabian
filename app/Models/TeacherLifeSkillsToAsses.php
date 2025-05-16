<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherLifeSkillsToAsses extends Model
{
    protected $table = 'teacher_life_skills_to_assess';

    protected $fillable = [
        'subjects_taught_by_teacher_id'
    ];

    public function subjectTaughtByTeacher()
    {
        return $this->belongsTo(SubjectsTaughtByTeachers::class, 'subjects_taught_by_teacher_id');
    }

    public function studentToAssessLifeSkill(){
        return $this->hasMany(StudentToAssessLifeSkill::class, 'teacher_life_skills_to_assess_id');
    }
}
