<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Habilidade;

class UserHabilidade extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'habilidade_id'
    ];
}
