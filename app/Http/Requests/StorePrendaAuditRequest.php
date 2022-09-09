<?php

namespace App\Http\Requests;

use App\Models\PrendaAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrendaAuditRequest extends FormRequest
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
            'descripcion' => [
                'string',
            ],
            'accion' => [
                'string',
            ],
            'user_id' => [
                'integer',
            ],
            'prendas_id' => [
                'integer',
            ],
        ];
    }
}
