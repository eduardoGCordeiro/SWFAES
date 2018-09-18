<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

            'identificador' => 'required|regex: /^[a-zA-Z0-9]*$/|'. Rule::unique('talhoes')->ignore($this->identificador,'identificador'),

            'area' => 'required|regex:/^\d+(\.\d{1,2})?$/',
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
            'area.regex' => 'O campo :attribute deve ser do tipo 00.00',
            'descricao.required' => 'O campo :attribute é obrigatório',
            'tipo.required' => 'O campo :attribute é obrigatório',
            'tipo.max' => 'O campo :attribute deve ter no máximo 15 caracteres!',
            'descricao.max' => 'O campo :attribute deve ter no máximo 45 caracteres!'
        ];
    }
}
