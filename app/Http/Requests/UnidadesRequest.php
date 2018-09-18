<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadesRequest extends FormRequest
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
            'nome' => 'string|max:45|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'sigla' => 'required|string|max:10|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
        ];
    }


    public function messages()
    {
        return [
            'sigla.required' => 'O campo :attribute é obrigatório',
            'sigla.string' => 'O campo :attribute deve ser uma palavra!',
            'sigla.max' => 'O campo :attribute deve ter no máximo 10 letras!',
            'sigla.regex' => 'O campo :attribute deve ter apenas letras!',
            'nome.string' => 'O campo :attribute deve ser uma palavra!',
            'nome.max' => 'O campo :attribute deve ter no máximo 45 letras!',
            'nome.regex' => 'O campo :attribute deve ter apenas letras!',
        ];
    }
}
