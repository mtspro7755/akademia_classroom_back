<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'apprenant_id',
        'thematique_id',
        'contenu',
        'description',
        'parent_post_id',
        'typePost'
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function thematique()
    {
        return $this->belongsTo(Thematique::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_post_id');
    }

    public function reponses()
    {
        return $this->hasMany(Post::class, 'parent_post_id');
    }
}
