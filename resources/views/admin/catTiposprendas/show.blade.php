@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.catTiposprenda.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cat-tiposprendas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.catTiposprenda.fields.id') }}
                        </th>
                        <td>
                            {{ $catTiposprenda->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catTiposprenda.fields.tipo') }}
                        </th>
                        <td>
                            {{ $catTiposprenda->tipo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catTiposprenda.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\CatTiposprenda::ESTATUS_RADIO[$catTiposprenda->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cat-tiposprendas.index') }}">
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
            <a class="nav-link" href="#tipoprenda_cat_tallas" role="tab" data-toggle="tab">
                {{ trans('cruds.catTalla.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tipoprenda_cat_tallas">
            @includeIf('admin.catTiposprendas.relationships.tipoprendaCatTallas', ['catTallas' => $catTiposprenda->tipoprendaCatTallas])
        </div>
    </div>
</div>

@endsection