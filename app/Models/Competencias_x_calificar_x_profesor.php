<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencias_x_calificar_x_profesor extends Model
{
    protected $table = 'competencias_x_calificar_x_profesores';

    protected $fillable = [
        'materia_impartida_x_profesorID'
    ];

    public function materiaImpartidaXProfesor()
    {
        return $this->belongsToMany(Materias_impartidas_x_profesor::class, 'materia_impartida_x_profesorID');
    }
}
