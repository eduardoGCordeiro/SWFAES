<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItensRequest extends FormRequest
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
            'nome' => 'required|string|max:46|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'custo_por_unidades' => 'required|regex:/^[0-9]+$/',
            'quantidade' => 'required|regex:/^[0-9]+$/ ',
        ];
    }


    public function messages()
    {
        return [
            'nome.string' => 'O campo :attribute deve ser uma palavra!',
            'nome.max' => 'O campo :attribute deve ter no máximo 46 letras!',
            'nome.regex' => 'O campo :attribute deve ter apenas letras!',
            'nome.required' => 'O campo :attribute é obrigatório!',
            'custo_por_unidades.required' => 'O campo :attribute é obrigatório!',
            'custo_por_unidades.regex' => 'O campo :attribute deve conter apenas números!',
            'quantidade.required' => 'O campo :attribute é obrigatório!',
            'quantidade.regex' => 'O campo :attribute deve conter apenas números!',
        ];
    }
}
