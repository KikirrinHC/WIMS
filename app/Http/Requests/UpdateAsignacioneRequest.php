<?php

namespace App\Http\Requests;

use App\Models\Asignacione;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAsignacioneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asignacion_edit');
    }

    public function rules()
    {
        return [
            'empleado_id' => [

                'integer',
            ],
            'qr' => [
                'string',

            ],

            'cat_tallas_id' => [
                'integer',
            ],
            'cat_tiposprendas_id' => [
                'integer',
            ],
        ];
    }
}
