<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name'
    ];

    public function teacher(){
        return $this->hasMany(Teacher::class, 'position_id');
    }
}
