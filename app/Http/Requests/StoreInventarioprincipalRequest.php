<?php

namespace App\Http\Requests;

use App\Models\Inventarioprincipal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInventarioprincipalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cat_inventarioprincipal_create');
    }

    public function rules()
    {
        return [
            'cat_tallas_id' => [
                'required',
                'integer',
            ],
            'cantidad' => [
                'integer',
                'required',
            ],
            'estatus' => [
                'required',
            ],
        ];
    }
}
