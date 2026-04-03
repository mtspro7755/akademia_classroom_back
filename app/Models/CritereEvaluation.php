<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CritereEvaluation extends Model
{
    protected $fillable = [
        'activite_id',
        'critere',
        'question',
        'point'
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function evaluations()
    {
        return $this->hasMany(EvaluationParScore::class);
    }
}
