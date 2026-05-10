<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cohorte extends Model
{
    protected $fillable = [
        'nom',
        'capaciteMax',
        'dateDebut',
        'dateFin',
        'statut',
        'parcours_formation_id',
        'prix',
        'devise',
    ];

    public function parcoursFormation()
    {
        return $this->belongsTo(ParcoursFormation::class,'parcours_formation_id');
    }

    public function apprenants()
    {
        return $this->belongsToMany(Apprenant::class,'apprenant_cohorte');
    }

    public function canalDeDiscussion(): HasMany
    {
        return $this->hasMany(CanalDeDiscussion::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }
}
