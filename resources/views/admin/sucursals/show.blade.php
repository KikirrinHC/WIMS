@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sucursal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sucursals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.id') }}
                        </th>
                        <td>
                            {{ $sucursal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.nombre') }}
                        </th>
                        <td>
                            {{ $sucursal->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.agencia') }}
                        </th>
                        <td>
                            {{ $sucursal->agencia->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.zona') }}
                        </th>
                        <td>
                            {{ $sucursal->zona->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.entidad') }}
                        </th>
                        <td>
                            {{ App\Models\Sucursal::ENTIDAD_SELECT[$sucursal->entidad] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.municipio') }}
                        </th>
                        <td>
                            {{ $sucursal->municipio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.direccion') }}
                        </th>
                        <td>
                            {{ $sucursal->direccion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sucursal.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\Sucursal::ESTATUS_RADIO[$sucursal->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sucursals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection