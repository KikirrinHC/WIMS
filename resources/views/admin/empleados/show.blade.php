@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empleado.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empleados.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.id') }}
                        </th>
                        <td>
                            {{ $empleado->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.clave') }}
                        </th>
                        <td>
                            {{ $empleado->clave }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.nombre') }}
                        </th>
                        <td>
                            {{ $empleado->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.sucursal') }}
                        </th>
                        <td>
                            {{ $empleado->sucursal->nombre ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empleados.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#empleado_asignaciones" role="tab" data-toggle="tab">
                {{ trans('cruds.asignacione.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="empleado_asignaciones">
            @includeIf('admin.empleados.relationships.empleadoAsignaciones', ['asignaciones' => $empleado->empleadoAsignaciones])
        </div>
    </div>
</div>

@endsection