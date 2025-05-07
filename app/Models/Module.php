<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $fillable = [
        'name',
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'module_id');
    }
}
