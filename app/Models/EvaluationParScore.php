<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationParScore extends Model
{
    protected $fillable = [
        'livrable_id',
        'critere_evaluation_id',
        'score',
        'commentaire'
    ];

    public function livrable()
    {
        return $this->belongsTo(Livrable::class);
    }

    public function critere()
    {
        return $this->belongsTo(CritereEvaluation::class,'critere_evaluation_id');
    }
}
