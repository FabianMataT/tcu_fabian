<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion_competencias_x_periodo_materias_x_estudiante extends Model
{
    protected $table = 'calificacion_competencias_x_periodo_materias_x_estudiantes';

    protected $fillable = [
        'calificacion_competencias_x_periodos_x_estudianteID', 
        'materia_impartida_x_profesorID', 
        'calificacion'
    ];

    public function calificacionPeriodo()
    {
        return $this->belongsTo(Calificacion_competencias_x_periodos_x_estudiante::class, 'calificacion_competencias_x_periodos_x_estudianteID');
    }

    public function materiaImpartida()
    {
        return $this->belongsTo(Materias_impartidas_x_profesor::class, 'materia_impartida_x_profesorID');
    }

    public function detalle_calificacion_competencias_x_materias_x_estudiante()
    {
        return $this->hasMany(Detalle_calificacion_competencias_x_materias_x_estudiante::class, 'calificacion_competencias_x_periodo_materias_x_estudiantesID');
    }
}
