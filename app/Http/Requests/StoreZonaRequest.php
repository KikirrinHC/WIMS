<?php

namespace App\Http\Requests;

use App\Models\Zona;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreZonaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zona_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:zonas',
            ],
            'descripcion' => [
                'string',
                'min:0',
                'max:255',
                'nullable',
            ],
            'estatus' => [
                'required',
            ],
        ];
    }
}
