<?php

namespace App\Http\Requests;

use App\Models\CatTiposprenda;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCatTiposprendaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cat_tiposprenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cat_tiposprendas,id',
        ];
    }
}
