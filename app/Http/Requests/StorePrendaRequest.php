<?php

namespace App\Http\Requests;

use App\Models\Prenda;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrendaRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('prenda_create');
        return Gate::allows('prenda_access');
    }

    public function rules()
    {
        return [

            'qr' => [
                'string',
                'required',
            ],
            'dias_uso' => [
                'integer',
            ],

            'user_id' => [
                'integer',
            ],
            'asignaciones_id' => [
                'integer',
            ],
            'cat_tiposprendas_id' => [
                'integer',
            ],
            'cat_tallas_id' => [
                'integer',
            ],
        ];
    }
}
