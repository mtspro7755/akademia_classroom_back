<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'activite_id',
        'intitule'
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function reponses()
    {
        return $this->hasMany(LivrableParQuestion::class);
    }
}
