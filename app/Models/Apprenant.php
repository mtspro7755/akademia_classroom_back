<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasName;

class Apprenant extends Authenticatable implements JWTSubject, HasName
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

    /**
     * Changement : Relation 1-1 vers ProfilApprenant.
     * Dans ton nouveau MCD, la liaison est directe entre l'entité centrale et son profil.
     */
    public function profil(): HasOne
    {
        return $this->hasOne(ProfilApprenant::class);
    }

    /**
     * Nouveauté MCD : Un apprenant peut avoir plusieurs candidatures.
     */
    /*public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }*/

    /**
     * Nouveauté MCD : Un apprenant peut composer un ou plusieurs groupes d'activités.
     */
    /*public function groupesActivites(): BelongsToMany
    {
        return $this->belongsToMany(GroupeActivite::class, 'apprenant_groupe')
            ->withTimestamps();
    }*/

    public function cohortes()
    {
        return $this->belongsToMany(Cohorte::class, 'apprenant_cohorte','apprenant_id', 'cohorte_id');
    }

    public function penalites()
    {
        return $this->hasMany(Penalite::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function quetes()
    {
        return $this->belongsToMany(Quete::class, 'apprenant_quete')
            ->withPivot(['statut','dureeEffective','dateSoumission'])
            ->withTimestamps();
    }

    public function livrables()
    {
        return $this->hasMany(Livrable::class);
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


    protected static function booted(): void
    {
        static::creating(function ($apprenant) {
            if (!$apprenant->pseudo) {
                $base = strtolower(preg_replace('/[^a-z0-9]/', '', $apprenant->nomComplet));
                $apprenant->pseudo = $base . '_' . substr(uniqid(), -6);
            }
        });
    }

    public function getFilamentName(): string
    {
        return $this->nomComplet ?? 'Admin' ;
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'formateur']) && $this->statutCompte;
    }

    public function scopeFormateurs($query)
    {
        return $query->where('role', 'formateur');
    }

    public function scopeApprenants($query)
    {
        return $query->where('role', 'apprenant');
    }
}
