<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_calificacion_competencias_x_materias_x_estudiante extends Model
{
    protected $table = 'detalle_calificacion_competencias_x_materias_x_estudiantes';

    protected $fillable = [
        'calificacion_competencias_x_periodo_materias_x_estudiantesID',
        'nombreCompetenciaDesarrolloHumano',
        'calificacion'
    ];

    public function calificacionMateriaPeriodo()
    {
        return $this->belongsTo(Calificacion_competencias_x_periodo_materias_x_estudiante::class, 'calificacion_competencias_x_periodo_materias_x_estudiantesID');
    }
}
