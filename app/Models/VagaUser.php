<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VagaUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'habilidade_id', 
        'contatado_por', 
        'interessado', 
        'data_contato'
    ];
}
