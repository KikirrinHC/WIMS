<?php

namespace App\Http\Requests;

use App\Models\Almacen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAlmacenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('almacen_edit');
    }

    public function rules()
    {
        return [
            'cat_tallas_id' => [
                //'required',
                'integer',
            ],
            'sucursals_id' => [
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
