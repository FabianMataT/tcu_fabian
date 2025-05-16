<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'specialtie_id', 
        'name'
    ];
    
    public function specialtie()
    {
        return $this->belongsTo(Specialtie::class, 'specialtie_id');
    }

    public function subjects_taught_by_teacher()
    {
        return $this->hasMany(SubjectsTaughtByTeachers::class, 'subject_id');
    }

    public function studentLifeSkillSubjectPeriodScore(){
        return $this->hasMany(StudentLifeSkillSubjectPeriodScore::class, 'subject_id');
    }
}
