<?php

namespace App\Http\Requests;

use App\Models\CatTalla;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCatTallaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cat_talla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cat_tallas,id',
        ];
    }
}
