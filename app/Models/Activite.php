<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activite extends Model
{
    protected $fillable=[
        'quete_id',
        'titre',
        'description',
        'duree',
        'statut',
        'ordreAffichage',
        'typeActivite',
        'typeLivrable',
        'modaliteTravail'
    ];

    public function quete()
    {
        return $this->belongsTo(Quete::class);
    }

    public function parcoursFormation()
    {
        return $this->hasOneThrough(ParcoursFormation::class, Quete::class, 'id', 'id', 'quete_id', 'parcours_formation_id');
    }

    public function criteres()
    {
        return $this->hasMany(CritereEvaluation::class);
    }

    public function livrables()
    {
        return $this->hasMany(Livrable::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function ressources(): BelongsToMany
    {
        return $this->belongsToMany(Ressource::class, 'activite_ressources')
            ->withPivot('type',
                'titre',
                'lienRessource',
                'pdfRessource')
            ->withTimestamps();
    }

    public function actives()
    {
        return Quete::where('statut', 'Actif')->get();
    }

    public function groupesActivites(): HasMany
    {
        return $this->hasMany(GroupeActivite::class);
    }
}
