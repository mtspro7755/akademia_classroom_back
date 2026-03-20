<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParcoursFormation extends Model
{
    protected $fillable = [
        'intitule'
    ];

    public function cohortes(): HasMany
    {
        return $this->hasMany(Cohorte::class);
    }

    public function quetes(): HasMany
    {
        return $this->hasMany(Quete::class);
    }
}
