@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.zona.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.zonas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">{{ trans('cruds.zona.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre" value="{{ old('nombre', '') }}" required>
                @if($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.zona.fields.descripcion') }}</label>
                <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                    name="descripcion" id="descripcion" value="{{ old('descripcion', '') }}">
                @if($errors->has('descripcion'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.zona.fields.entidad') }}</label>
                <select class="form-control {{ $errors->has('entidad') ? 'is-invalid' : '' }}" name="entidad"
                    id="entidad">
                    <option value disabled {{ old('entidad', null)===null ? 'selected' : '' }}>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Zona::ENTIDAD_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('entidad', '' )===(string) $key ? 'selected' : '' }}>{{ $label }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('entidad'))
                <div class="invalid-feedback">
                    {{ $errors->first('entidad') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.entidad_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.zona.fields.estatus') }}</label>
                @foreach(App\Models\Zona::ESTATUS_RADIO as $key => $label)
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
                <span class="help-block">{{ trans('cruds.zona.fields.estatus_helper') }}</span>
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