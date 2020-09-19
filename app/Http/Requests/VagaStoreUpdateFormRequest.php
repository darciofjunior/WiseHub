<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagaStoreUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'habilidade_id'     => 'required|exists:habilidades,id', 
            'local_id'          => 'required|exists:locals,id', 
            'tipo_contratacao'  => 'required',
            'budget'            => 'required',
            'data_cadastro'     => 'date',
        ];
    }
}
