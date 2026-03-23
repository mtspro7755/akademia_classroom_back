<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'typeProfil',
        'description',
        'niveauMinimal',
        'niveauMaximal'
    ];

    public function apprenants()
    {
        return $this->hasMany(Apprenant::class);
    }
}
