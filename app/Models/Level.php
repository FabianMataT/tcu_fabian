<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'level',
        'name'
    ];

    public function grup()
    {
        return $this->hasMany(Grup::class, 'nivelID');
    }
}
