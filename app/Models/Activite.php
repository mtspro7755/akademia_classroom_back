<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'typeLivrable'
    ];

    public function quete()
    {
        return $this->belongsTo(Quete::class);
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
}
