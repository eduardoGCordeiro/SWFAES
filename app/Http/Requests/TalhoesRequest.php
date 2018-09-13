<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalhoesRequest extends FormRequest
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
            'identificador' => 'required|regex: /^[a-zA-Z0-9]*$/|unique:talhoes',
            'area' => 'required',
            'descricao' => 'required|string|max:400',
            'tipo'=>'required|string|max:15',
            'id_adms_talhoes_adms_talhoes' => '',
        ];
    }


    public function messages()
    {
        return [
            'identificador.required' => 'O campo :attribute é obrigatório',
            'identificador.unique' => 'O campo :attribute deve ser único!',
            'identificador.regex' => 'O campo :attribute deve conter apenas letras e números, sem caracteres especiais!',
            'area.required' => 'O campo :attribute é obrigatório',
            'descricao.required' => 'O campo :attribute é obrigatório',
        ];
    }
}
