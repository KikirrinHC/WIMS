@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.catTalla.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cat-tallas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.catTalla.fields.id') }}
                        </th>
                        <td>
                            {{ $catTalla->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catTalla.fields.tipoprenda') }}
                        </th>
                        <td>
                            {{ $catTalla->tipoprenda->tipo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catTalla.fields.talla') }}
                        </th>
                        <td>
                            {{ $catTalla->talla }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catTalla.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\CatTalla::ESTATUS_RADIO[$catTalla->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cat-tallas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection