<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'apprenant_id',
        'canal_de_discussion_id',
        'contenu',
    ];

    /**
     * Le message a été rédigé par un apprenant.
     */
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }

    /**
     * Le message appartient à un canal spécifique.
     */
    public function canal(): BelongsTo
    {
        return $this->belongsTo(CanalDeDiscussion::class, 'canal_de_discussion_id');
    }
}
