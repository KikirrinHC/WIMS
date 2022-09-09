@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.agencium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.agencium.fields.id') }}
                        </th>
                        <td>
                            {{ $agencium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agencium.fields.nombre') }}
                        </th>
                        <td>
                            {{ $agencium->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agencium.fields.empresa') }}
                        </th>
                        <td>
                            {{ $agencium->empresa->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agencium.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\Agencium::ESTATUS_RADIO[$agencium->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencia.index') }}">
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
            <a class="nav-link" href="#agencia_sucursals" role="tab" data-toggle="tab">
                {{ trans('cruds.sucursal.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="agencia_sucursals">
            @includeIf('admin.agencia.relationships.agenciaSucursals', ['sucursals' => $agencium->agenciaSucursals])
        </div>
    </div>
</div>

@endsection