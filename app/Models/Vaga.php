<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'habilidade_id', 
        'local_id', 
        'tipo_contratacao', 
        'budget', 
        'data_cadastro',
        'contatado_por', 
        'interessado', 
        'data_contato'
    ];

    public function habilidade()
    {
        return $this->hasOne(Habilidade::class, 'id', 'habilidade_id');
    }

    public function local()
    {
        return $this->hasOne(Local::class, 'id', 'local_id');
    }

    //Transforma a Preço no formato que o MySQL trabalha ...
    public function formatar_moeda($preco)
    {
        $preco = str_replace('.', '', $preco);//Tira o separador de milhar ...
        $preco = str_replace(',', '.', $preco);//Transforma o decimal em ponto ...

        return $preco;
    }
}
