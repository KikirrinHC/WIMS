<?php

namespace App\Http\Requests;

use App\Models\Asignacione;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAsignacioneRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asignacione_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:asignaciones,id',
        ];
    }
}
