<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion_competencias_estudiante extends Model
{
    protected $table = 'calificacion_competencias_estudiantes';

    protected $fillable = [
        'estudianteID',
        'calificacionCompetencia'
    ];
    
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteID');
    }
}
