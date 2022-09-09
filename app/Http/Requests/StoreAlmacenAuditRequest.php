<?php

namespace App\Http\Requests;

use App\Models\InventarioprincipalAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAlmacenAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cat_almacen_audit_create');
    }

    public function rules()
    {
        return [

            'cantidad' => [
                'integer',
                'required',
            ],
            'accion' => [
                'required',
            ],
            'descripcion' => [],
        ];
    }
}
