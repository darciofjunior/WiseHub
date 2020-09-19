<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidade extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'habilidade', 
    ];

    public function users()
    {
        return $this->belongsToMany(UserHabilidade::class, Habilidade::class, 'habilidade_id', 'user_id');
    }
}
