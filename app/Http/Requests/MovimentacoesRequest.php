<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentacoesRequest extends FormRequest
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
            'custo' => 'required',
            'quantidade' => 'required',
            'tipo_movimentacoes' => 'required|string|max:1',
            'id_itens_itens'=>'',
            'id_atividades_atividades' => '',
            'descricao' => 'string|max:200'
        ];
    }

    public function messages()
    {
        return [
            'custo.required' => 'O campo :attribute é obrigatório!',
            'quantidade.required' => 'O campo :attribute é obrigatório!',
            'tipo_movimentacoes.required' => 'O campo :attribute é obrigatório!',
            'descricao.max' => 'O campo :attribute deve conter no máximo 200 caracteres!',
            'descricao.string' => 'O campo :attribute deve ser texto!',
        ];
    }
}
