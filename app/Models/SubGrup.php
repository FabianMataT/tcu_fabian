<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubGrup extends Model
{
    protected $table = 'sub_grups';

    protected $fillable = [
        'grup_id',
        'specialtie_id',
        'name'
    ];

    public function grup()
    {
        return $this->belongsTo(Grup::class, 'grup_id');
    }

    public function specialtie()
    {
        return $this->belongsTo(Specialtie::class, 'specialtie_id');
    }

    public function subjects_taught_by_teacher(){
        return $this->hasMany(SubjectsTaughtByTeachers::class, 'sub_grup_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'sub_grup_id');
    }
}
