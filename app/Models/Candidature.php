<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidature extends Model
{
    protected $fillable = [
        'apprenant_id',
        'statut',
    ];

    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }
}
