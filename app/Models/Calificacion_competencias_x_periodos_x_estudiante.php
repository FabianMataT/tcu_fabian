<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion_competencias_x_periodos_x_estudiante extends Model
{
    protected $table = 'calificacion_competencias_x_periodos_x_estudiantes';

    protected $fillable = [
        'estudianteID', 
        'calificacion', 
        'periodo'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteID');
    }

    public function calificacion_competencias_x_periodo_materias_x_estudiante()
    {
        return $this->hasMany(Calificacion_competencias_x_periodo_materias_x_estudiante::class, 'calificacion_competencias_x_periodos_x_estudianteID');
    }
    
}
