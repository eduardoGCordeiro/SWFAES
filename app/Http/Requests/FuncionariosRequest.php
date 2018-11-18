<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Funcionario;
use Illuminate\Validation\Rule;

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

            'login'=>'required|min:3|max:45|regex:/^[a-z0-9A-Z_]+$/|string|'. Rule::unique('funcionarios')->ignore($this->login,'login'),
            'nome' => 'required|string|min:3|max:45|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|',
            'email' => 'required|string|email|max:45|'.Rule::unique('funcionarios')->ignore($this->email,'email'),
            'cpf' => 'required|max:11|min:11|cpf|'.Rule::unique('funcionarios')->ignore($this->cpf,'cpf'),
            'password' => 'string|min:6|confirmed',
            'acesso_sistema' =>''
        ];
    }
    public function messages()
    {
        return [
            'cpf.required' => 'O campo :attribute é obrigatório',
            'cpf.unique' => 'O campo :attribute deve ser único!',
            'cpf.max' => 'O campo :attribute conter 11 caracteres!',
            'cpf.min' => 'O campo :attribute conter 11 caracteres!',
            'cpf.regex' => 'O campo :attribute conter apenas números!',
            'nome.string' => 'O campo :attribute deve ser uma palavra!',
            'nome.max' => 'O campo :attribute deve ter no máximo 45 letras!',
            'nome.regex' => 'O campo :attribute deve ter apenas letras!',
            'nome.required' => 'O campo :attribute é obrigatório',
            'login.string' => 'O campo :attribute deve ser uma palavra!',
            'login.max' => 'O campo :attribute deve ter no máximo 45 letras!',
            'login.regex' => 'O campo :attribute deve ter apenas letras!',
            'login.required' => 'O campo :attribute é obrigatório',
            'login.unique' => 'O campo :attribute deve ser único!',
            'email.string' => 'O campo :attribute deve ser uma palavra!',
            'email.max' => 'O campo :attribute deve ter no máximo 45 letras!',
            'email.unique' => 'O campo :attribute deve ser único!',
            'email.required' => 'O campo :attribute é obrigatório',
            'email.email' => 'O campo :attribute deve ser um e-mail da seguinte forma: example@teste.com',
            'password.confirmed' => 'O campo :attribute é obrigatório',
            'password.string' => 'O campo :attribute deve ser uma palavra!',
            'password.max' => 'O campo :attribute conter 11 caracteres!',
        ];
    }
}
