<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionariosRequest extends FormRequest
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
            'cpf'=>'required',
            'login'=>'required|unique:funcionarios',
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios',
            'cpf' => 'required|string|max:255|unique:funcionarios',
            'password' => 'string|min:6|confirmed',
            'acesso_sistema'
        ];
    }
}
