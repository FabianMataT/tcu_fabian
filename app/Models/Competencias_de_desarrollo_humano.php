<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencias_de_desarrollo_humano extends Model
{
    protected $table = 'competencias_desarrollo_humanos';

    protected $fillable = [
        'nombre', 
        'descripcion'
    ];
}
