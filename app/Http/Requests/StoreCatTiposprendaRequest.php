<?php

namespace App\Http\Requests;

use App\Models\CatTiposprenda;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCatTiposprendaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cat_tiposprenda_create');
    }

    public function rules()
    {
        return [
            'tipo' => [
                'string',
                'min:0',
                'max:50',
                'required',
                'unique:cat_tiposprendas',
            ],
            'estatus' => [
                'required',
            ],
        ];
    }
}
