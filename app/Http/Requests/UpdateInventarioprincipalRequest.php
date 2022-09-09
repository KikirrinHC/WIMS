<?php

namespace App\Http\Requests;

use App\Models\Inventarioprincipal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInventarioprincipalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inventarioprincipal_edit');
    }

    public function rules()
    {
        return [
            'cat_tallas_id' => [
                //'required',
                'integer',
            ],
            'cantidad' => [
                'required',
                'integer',
            ],
            'estatus' => [
                //'required',
            ],
        ];
    }
}
