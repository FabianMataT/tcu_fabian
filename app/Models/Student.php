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

    public function estudiantes_a_calificar_competencia()
    {
        return $this->hasMany(Estudiantes_a_calificar_competencia::class, 'estudianteID');
    }

    public function calificacion_competencias_estudiante()
    {
        return $this->belongsTo(Calificacion_competencias_estudiante::class, 'estudianteID');
    }

    public function calificacion_competencias_x_periodos_x_estudiante()
    {
        return $this->hasMany(Calificacion_competencias_x_periodos_x_estudiante::class, 'estudianteID');
    }
    
}
