@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empresa.title') }}
    </div>
    
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empresas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.id') }}
                        </th>
                        <td>
                            {{ $empresa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.nombre') }}
                        </th>
                        <td>
                            {{ $empresa->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.logo') }}
                        </th>
                        <td>
                            @if($empresa->logo)
                                <a href="{{ $empresa->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $empresa->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.razonsocial') }}
                        </th>
                        <td>
                            {{ $empresa->razonsocial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.rfc') }}
                        </th>
                        <td>
                            {{ $empresa->rfc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\Empresa::ESTATUS_RADIO[$empresa->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empresas.index') }}">
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
            <a class="nav-link" href="#empresa_agencia" role="tab" data-toggle="tab">
                {{ trans('cruds.agencium.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="empresa_agencia">
            @includeIf('admin.empresas.relationships.empresaAgencia', ['agencia' => $empresa->empresaAgencia])
        </div>
    </div>
</div>

@endsection