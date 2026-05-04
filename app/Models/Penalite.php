<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalite extends Model
{
    protected $fillable = [
        'apprenant_id',
        'dureeInitial',
        'tempsDeRetard',
        'penalite',
        'type_enum',
        'justificatif',
        'livrable_id'
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public static function booted()
    {
        static::creating(function ($penalite) {
           $penalite->penalite = $penalite->tempsDeRetard * 10;
        });
    }

    public function livrable(): BelongsTo
    {
        return $this->belongsTo(Livrable::class);
    }
}
