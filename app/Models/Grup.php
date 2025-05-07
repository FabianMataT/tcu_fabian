<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    protected $fillable = [
        'level_id',
        'name'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function subGrup()
    {
        return $this->hasMany(SubGrup::class, 'grup_id');
    }

    public function specialtiesXGrup()
    {
        return $this->hasManyThrough(
            Specialtie::class,  
            SubGrup::class,      
            'grup_id',            
            'id',                 
            'id',                
            'specialtie_id'  
        )->select('acronym'); 
    }
}
