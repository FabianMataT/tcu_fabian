<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Specialtie extends Model
{
    protected $fillable = [
        'acronym',
        'name',
        'description',
        'image_path',
        'slug',
    ];

    public function subject() 
    {
        return $this->hasMany(Subject::class, 'specialtie_id');
    }

    public function subGrup()
    {
        return $this->hasMany(SubGrup::class, 'specialtie_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image() : Attribute
    {
        return Attribute::make(
            get : fn () => $this->image_path ? Storage::url($this->image_path) : asset('images/no-image.png') 
        );
    } 
}
