<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiantes_a_calificar_competencia extends Model
{
    protected $table = 'estudiantes_a_calificar_competencias';

    protected $fillable = [
        'estudianteID'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteID');
    }
}
