<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CulturasRequest extends FormRequest
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

            'data_inicio' => 'required',
            'data_fim' => '',
            'descricao'=>'required|max:100|string',
            'tipo_safra'=>'required|string|max:15',
        ];
    }


    public function messages()
    {
        return [
            'descricao.required' => 'O campo :attribute é obrigatório',
            'data_inicio.required' => 'O campo :attribute é obrigatório!',
            'descricao.max' => 'O campo :attribute deve ter no máximo 100 caracteres!',
            'descricao.string' => 'O campo :attribute deve ser uma palavra!',
            'tipo_safra.required' => 'O campo :attribute é obrigatório',
            'tipo_safra.max' => 'O campo :attribute deve ter no máximo 15 caracteres!',
        ];
    }
}
