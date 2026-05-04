<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupeActivite extends Model
{
    protected $fillable = ['nom', 'activite_id'];

    public function activite(): BelongsTo
    {
        return $this->belongsTo(Activite::class);
    }

    public function apprenants(): HasMany
    {
        return $this->hasMany(Apprenant::class, 'groupe_activite_id');
    }
}
