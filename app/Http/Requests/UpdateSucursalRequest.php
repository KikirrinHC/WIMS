<?php

namespace App\Http\Requests;

use App\Models\Sucursal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSucursalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sucursal_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:sucursals,nombre,' . request()->route('sucursal')->id,
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
