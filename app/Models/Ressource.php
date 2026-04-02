<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ressource extends Model
{
    protected $casts = [
        'type' => 'string',
    ];

    public function activites(): BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'activite_ressources')
            ->withPivot('type')
            ->withTimestamps();
    }
}
