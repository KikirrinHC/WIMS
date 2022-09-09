@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Detalle de la asignación
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.asignaciones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.asignacion.fields.id') }}
                        </th>
                        <td>
                            {{ $asignacione->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asignacion.fields.empleado') }}
                        </th>
                        <td>
                            {{ $asignacione->empleado->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asignacion.fields.qr') }}
                        </th>
                        <td>
                            {{ $asignacione->qr }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.asignaciones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection