<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisicoesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> eduardo
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
<<<<<<< HEAD
        return [
            //
=======

        return [
            'data' => '',
            'descricao_adms_gerais' => 'max:100|string',
            'descricao'=>'required|max:100|string',
        ];
    }
    public function messages()
    {
        return [
            'descricao.required' => 'O campo :attribute é obrigatório',
            'descricao.max' => 'O campo :attribute deve ter no máximo 100 caracteres!',
            'descricao.string' => 'O campo :attribute deve ser uma palavra!',
            'data.required' => 'O campo :attribute é obrigatório',
            'descricao_adms_gerais.max' => 'O campo :attribute deve ter no máximo 100 caracteres!',
            'descricao_adms_gerais.string' => 'O campo :attribute deve ser uma palavra!',
>>>>>>> eduardo
        ];
    }
}
