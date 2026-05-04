<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CanalDeDiscussion extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'cohorte_id'
    ];

    /**
     * Descanal appartient à une seule cohorte (Relation *..1).
     */
    public function cohorte(): BelongsTo
    {
        return $this->belongsTo(Cohorte::class);
    }

    /**
     * Un canal contient plusieurs messages (0..*).
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
