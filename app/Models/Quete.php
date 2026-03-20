<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quete extends Model
{
    protected $fillable = [
        'titre',
        'statut',
        'dateDebut',
        'dateLimite',
        'niveauDifficulte',
        'parcours_formation_id'
    ];

    public function parcoursFormation()
    {
        return $this->belongsTo(ParcoursFormation::class);
    }

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function apprenants()
    {
        return $this->belongsToMany(Apprenant::class, 'apprenant_quete')
            ->withPivot(['statut','dureeEffective','dateSoumission'])
            ->withTimestamps();
    }
}
