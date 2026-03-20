<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Apprenant extends Authenticatable implements JWTSubject
{
    use Notifiable, CanResetPassword;

    protected $fillable = [
        'nomComplet',
        'email',
        'phone',
        'password',
        'pseudo',
        'role',
        'statutCompte',
        'profil_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'statutCompte' => 'boolean',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'role' => $this->role,
            'pseudo' => $this->pseudo
        ];
    }
}
