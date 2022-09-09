@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.zona.title_singular') }}
    </div>

    <div class="card-body">
<<<<<<< HEAD
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
=======
        <form method="POST" action="{{ route("admin.zonas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">{{ trans('cruds.zona.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}" required>
                @if($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.zona.fields.descripcion') }}</label>
<<<<<<< HEAD
                <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                    name="descripcion" id="descripcion" value="{{ old('descripcion', '') }}">
                @if($errors->has('descripcion'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion') }}
                </div>
=======
                <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', '') }}">
                @if($errors->has('descripcion'))
                    <span class="text-danger">{{ $errors->first('descripcion') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.zona.fields.entidad') }}</label>
<<<<<<< HEAD
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
=======
                <select class="form-control {{ $errors->has('entidad') ? 'is-invalid' : '' }}" name="entidad" id="entidad">
                    <option value disabled {{ old('entidad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Zona::ENTIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('entidad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('entidad'))
                    <span class="text-danger">{{ $errors->first('entidad') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.entidad_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.zona.fields.estatus') }}</label>
                @foreach(App\Models\Zona::ESTATUS_RADIO as $key => $label)
<<<<<<< HEAD
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
=======
                    <div class="form-check {{ $errors->has('estatus') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="estatus_{{ $key }}" name="estatus" value="{{ $key }}" {{ old('estatus', 'Activo') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="estatus_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('estatus'))
                    <span class="text-danger">{{ $errors->first('estatus') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.zona.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
<<<<<<< HEAD
                <button class="btn btn-primary" type="submit">
=======
                <button class="btn btn-danger" type="submit">
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection