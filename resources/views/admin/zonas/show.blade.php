@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.zona.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zonas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.zona.fields.id') }}
                        </th>
                        <td>
                            {{ $zona->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zona.fields.nombre') }}
                        </th>
                        <td>
                            {{ $zona->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zona.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $zona->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zona.fields.entidad') }}
                        </th>
                        <td>
                            {{ App\Models\Zona::ENTIDAD_SELECT[$zona->entidad] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zona.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\Zona::ESTATUS_RADIO[$zona->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zonas.index') }}">
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
            <a class="nav-link" href="#zona_sucursals" role="tab" data-toggle="tab">
                {{ trans('cruds.sucursal.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="zona_sucursals">
            @includeIf('admin.zonas.relationships.zonaSucursals', ['sucursals' => $zona->zonaSucursals])
        </div>
    </div>
</div>

@endsection