<?php

namespace App\Http\Requests;

use App\Models\Zona;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateZonaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zona_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:zonas,nombre,' . request()->route('zona')->id,
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
