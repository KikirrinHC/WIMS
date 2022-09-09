<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmpresaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empresa_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:3',
                'max:50',
                'required',
                'unique:empresas',
            ],
            'razonsocial' => [
                'string',
                'min:5',
                'max:50',
                'nullable',
            ],
            'rfc' => [
                'string',
                'min:10',
                'max:15',
                'nullable',
            ],
        ];
    }
}
