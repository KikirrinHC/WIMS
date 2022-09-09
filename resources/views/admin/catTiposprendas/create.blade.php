@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.catTiposprenda.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.cat-tiposprendas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tipo">{{ trans('cruds.catTiposprenda.fields.tipo') }}</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo"
                    id="tipo" value="{{ old('tipo', '') }}" required>
                @if($errors->has('tipo'))
                <div class="invalid-feedback">
                    {{ $errors->first('tipo') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.catTiposprenda.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.catTiposprenda.fields.estatus') }}</label>
                @foreach(App\Models\CatTiposprenda::ESTATUS_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('estatus') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="estatus_{{ $key }}" name="estatus"
                        value="{{ $key }}" {{ old('estatus', 'Activo' )===(string) $key ? 'checked' : '' }} required>
                    <label class="form-check-label" for="estatus_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('estatus'))
                <div class="invalid-feedback">
                    {{ $errors->first('estatus') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.catTiposprenda.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection