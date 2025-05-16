<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name1',
        'last_name2',
        'email',
        'phone',
        'user_id',
        'position_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    
    public function subjects_taught_by_teacher()
    {
        return $this->hasMany(SubjectsTaughtByTeachers::class, 'teacher_id');
    }
    
    public function studentLifeSkillSubjectPeriodScore(){
        return $this->hasMany(StudentLifeSkillSubjectPeriodScore::class, 'teacher_id');
    }
}
