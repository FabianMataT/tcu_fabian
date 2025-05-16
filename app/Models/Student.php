<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [ 
        'sub_grup_id', 
        'id_card', 
        'first_name',
        'middle_name',
        'last_name1',
        'last_name2',
    ];

    public function subGrup()
    {
        return $this->belongsTo(SubGrup::class, 'sub_grup_id');
    }

    public function studentToAssessLifeSkill(){
        return $this->hasMany(StudentToAssessLifeSkill::class, 'student_id');
    }

    public function studentLifeSkillScore()
    {
        return $this->hasMany(StudentLifeSkillScore::class, 'student_id');
    }

    public function studentLifeSkillPeriodScore()
    {
        return $this->hasMany(StudentLifeSkillPeriodScore::class, 'student_id');
    }
    
}
