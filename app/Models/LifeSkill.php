<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifeSkill extends Model
{
    protected $table = 'life_skills';

    protected $fillable = [
        'name', 
        'description'
    ];
}
