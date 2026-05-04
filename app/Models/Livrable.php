<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Livrable extends Model
{
    protected $fillable = [
        'apprenant_id',
        'activite_id',
        'lienDuRepertoire',
        'lienDeploye',
        'typeLivrable',
        'statutCorrection',
        'dateSoumission',
        'dureeEffectue',
        'dureeActivite',
        'estEnRetard',
        'minutesRetard',
    ];

    protected $casts = [
        'estEnRetard' => 'boolean',
        'dateSoumission' => 'datetime',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationParScore::class);
    }

    public function feedback()
    {
        return $this->hasOne(EvaluationParFeedback::class);
    }

    public function reponsesQuestions()
    {
        return $this->hasMany(LivrableParQuestion::class);
    }

    public function penalites(): HasMany
    {
        return $this->hasMany(Penalite::class);
    }

}
