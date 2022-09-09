<?php

namespace App\Http\Requests;

use App\Models\Sucursal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSucursalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sucursal_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:sucursals',
            ],
            'agencia_id' => [
                'required',
                'integer',
            ],
            'zona_id' => [
                'required',
                'integer',
            ],
            'municipio' => [
                'string',
                'min:5',
                'max:50',
                'nullable',
            ],
            'direccion' => [
                'string',
                'min:5',
                'max:100',
                'nullable',
            ],
            'estatus' => [
                'required',
            ],
        ];
    }
}
