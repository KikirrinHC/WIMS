<?php

namespace App\Http\Requests;

use App\Models\Asignacione;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAsignacioneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asignacion_create');
    }

    public function rules()
    {
        return [
            'empleado_id' => [
                'required',
                'integer',
            ],
            'qr' => [
                'string',
                'required',
            ],
            'descripcion' => [],
            'cat_tallas_id' => [
                'integer',
                'required',
            ],
            'cat_tiposprendas_id' => [
                'integer',
                'required',
            ],
            'sucursals_id' => [
                'integer',

            ],
        ];
    }
}
