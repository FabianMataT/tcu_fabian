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

    public function competencias_x_calificar_x_profesor()
    {
        return $this->belongsToMany(Competencias_x_calificar_x_profesor::class, 'materia_impartida_x_profesorID');
    }

    public function calificacion_competencias_x_periodo_materias_x_estudiante()
    {
        return $this->hasMany(Calificacion_competencias_x_periodo_materias_x_estudiante::class, 'materia_impartida_x_profesorID');
    }
}
