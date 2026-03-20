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
        'penalite'
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }
}
