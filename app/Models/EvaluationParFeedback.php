<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationParFeedback extends Model
{
    protected $fillable = [
        'livrable_id',
        'avisCritique'
    ];

    public function livrable()
    {
        return $this->belongsTo(Livrable::class);
    }
}
