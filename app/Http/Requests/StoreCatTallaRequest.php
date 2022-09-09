<?php

namespace App\Http\Requests;

use App\Models\CatTalla;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCatTallaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cat_talla_create');
    }

    public function rules()
    {
        return [
            'tipoprenda_id' => [
                'required',
                'integer',
            ],
            'talla' => [
                'string',
                'min:0',
                'max:50',
                'required',
            ],
            'estatus' => [
                'required',
            ],
        ];
    }
}
