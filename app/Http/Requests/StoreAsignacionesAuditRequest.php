<?php

namespace App\Http\Requests;

use App\Models\AsignacionesAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAsignacionesAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asignaciones_audit_create');
    }

    public function rules()
    {
        return [

            'qr' => [
                'text',
                'required',
            ],
            'accion' => [
                'required',
            ],
            'descripcion' => [],
        ];
    }
}
