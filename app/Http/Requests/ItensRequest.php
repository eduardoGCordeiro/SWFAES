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
            'nome'=>,'required'
            'custo_por_unidade'=>'required',
            'quantidade'=>'required',
            'id_unidades_unidades'=>'required',
            'id_tipos_item_tipos_item'=>'required'
        ];
    }
}
