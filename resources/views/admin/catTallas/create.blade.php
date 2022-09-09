@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.catTalla.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.cat-tallas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tipoprenda_id">{{ trans('cruds.catTalla.fields.tipoprenda') }}</label>
                <select class="form-control select2 {{ $errors->has('tipoprenda') ? 'is-invalid' : '' }}"
                    name="tipoprenda_id" id="tipoprenda_id" required>
                    @foreach($tipoprendas as $id => $entry)
                    <option value="{{ $id }}" {{ old('tipoprenda_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipoprenda'))
                <div class="invalid-feedback">
                    {{ $errors->first('tipoprenda') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.catTalla.fields.tipoprenda_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="talla">{{ trans('cruds.catTalla.fields.talla') }}</label>
                <input class="form-control {{ $errors->has('talla') ? 'is-invalid' : '' }}" type="text" name="talla"
                    id="talla" value="{{ old('talla', '') }}" required>
                @if($errors->has('talla'))
                <div class="invalid-feedback">
                    {{ $errors->first('talla') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.catTalla.fields.talla_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.catTalla.fields.estatus') }}</label>
                @foreach(App\Models\CatTalla::ESTATUS_RADIO as $key => $label)
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
                <span class="help-block">{{ trans('cruds.catTalla.fields.estatus_helper') }}</span>
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