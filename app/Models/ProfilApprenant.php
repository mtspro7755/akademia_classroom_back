<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilApprenant extends Model
{
    protected $table = 'profil_apprenants';

    protected $fillable = [
        'aPropos',
        'niveauEtudes',
        'profession',
        'ville',
        'adresse',
        'photoProfil',
        'photoCouverture',
        'totalLivrables',
        'totalRetards',
        'apprenant_id'
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }
}
