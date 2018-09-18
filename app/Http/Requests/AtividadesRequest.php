<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadesRequest extends FormRequest
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

            'data_registro' => '',
            'data' => 'required',
            'descricao'=>'required|max:45|string',
        ];
    }


    public function messages()
    {
        return [
            'descricao.required' => 'O campo :attribute é obrigatório',
            'data_data.required' => 'O campo :attribute é obrigatório!',
            'descricao.max' => 'O campo :attribute deve ter no máximo 45 caracteres!',
            'descricao.string' => 'O campo :attribute deve ser uma palavra!',
        ];
    }
}
