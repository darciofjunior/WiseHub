<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreUpdateFormRequest extends FormRequest
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
        $user_id = (Auth::check()) ? Auth::User()->id : '';

        return [
            'nome'              => 'required|min:3|max:50',
            'email'             => "required|min:10|max:80|unique:users,email,{$user_id},id",
            'telefone'          => 'required|min:9|',
            'password'          => 'min:6|max:15',
            'experiencia'       => 'required',
            'local_id'          => 'required|exists:locals,id', 
            'tipo_contratacao'  => 'required',
            'data_cadastro'     => 'date'
        ];
    }
}
