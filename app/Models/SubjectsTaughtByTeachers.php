<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectsTaughtByTeachers extends Model
{
    protected $table = 'subjects_taught_by_teachers';

    protected $fillable = [
        'teacher_id',
        'sub_grup_id',
        'subject_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function subGrup()
    {
        return $this->belongsTo(SubGrup::class, 'sub_grup_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacherLifeSkillsToAssess()
    {
        return $this->hasMany(TeacherLifeSkillsToAsses::class, 'subjects_taught_by_teacher_id');
    }

}
