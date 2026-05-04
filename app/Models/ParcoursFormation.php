<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ParcoursFormation extends Model
{
    protected $fillable = [
        'intitule',
        'type'
    ];

    public function cohortes(): HasMany
    {
        return $this->hasMany(Cohorte::class, 'parcours_formation_id');
    }

    public function quetes(): HasMany
    {
        return $this->hasMany(Quete::class);
    }
}
