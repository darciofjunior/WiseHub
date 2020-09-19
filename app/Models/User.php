<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Habilidade;
use App\Models\Local;
use App\Models\UserHabilidade;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'local_id', 
        'nome', 
        'email', 
        'telefone', 
        'password', 
        'experiencia', 
        'tipo_contratacao', 
        'data_cadastro'
    ];

    protected $hidden = 'password';

    public function local()
    {
        return $this->hasOne(Local::class, 'id', 'local_id');
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidade::class, UserHabilidade::class, 'user_id', 'habilidade_id');
    }
}
