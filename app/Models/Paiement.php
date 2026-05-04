<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'montant',
        'devise',
        'moyenPaiement',
        'telephone',
        'referenceTransaction',
        'statut',
        'datePaiement',
        'apprenant_id',
        'cohorte_id'
    ];

    protected $casts = [
        'datePaiement' => 'datetime',
        'montant' => 'decimal:2'
    ];

    /**
     * Un paiement est effectué par un apprenant.
     */
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }

    /**
     * Un paiement concerne une cohorte spécifique.
     */
    public function cohorte(): BelongsTo
    {
        return $this->belongsTo(Cohorte::class);
    }

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }
}
