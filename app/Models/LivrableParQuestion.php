<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivrableParQuestion extends Model
{
    protected $table = 'livrable_par_questions';

    protected $fillable = [
        'livrable_id',
        'question_id',
        'reponse'
    ];

    public function livrable()
    {
        return $this->belongsTo(Livrable::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
