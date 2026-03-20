<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    protected $fillable = [
        'titre',
        'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
