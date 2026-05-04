<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidature extends Model
{
    protected $fillable = [
        'apprenant_id',
        'statut',
    ];

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }
}
