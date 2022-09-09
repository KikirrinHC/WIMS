<?php

namespace App\Http\Requests;

use App\Models\Agencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAgenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agencium_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'min:5',
                'max:50',
                'required',
            ],
            'empresa_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
