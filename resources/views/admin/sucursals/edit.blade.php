@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sucursal.title_singular') }}
    </div>

    <div class="card-body">
<<<<<<< HEAD
        <form method="POST" action="{{ route('admin.sucursals.update, [$sucursal->id]) }}"
            enctype="multipart/form-data">
=======
        <form method="POST" action="{{ route("admin.sucursals.update", [$sucursal->id]) }}" enctype="multipart/form-data">
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">{{ trans('cruds.sucursal.fields.nombre') }}</label>
<<<<<<< HEAD
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre" value="{{ old('nombre', $sucursal->nombre) }}" required>
                @if($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
=======
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', $sucursal->nombre) }}" required>
                @if($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agencia_id">{{ trans('cruds.sucursal.fields.agencia') }}</label>
<<<<<<< HEAD
                <select class="form-control select2 {{ $errors->has('agencia') ? 'is-invalid' : '' }}" name="agencia_id"
                    id="agencia_id" required>
                    @foreach($agencias as $id => $entry)
                    <option value="{{ $id }}" {{ (old('agencia_id') ? old('agencia_id') : $sucursal->agencia->id ?? '')
                        == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agencia'))
                <div class="invalid-feedback">
                    {{ $errors->first('agencia') }}
                </div>
=======
                <select class="form-control select2 {{ $errors->has('agencia') ? 'is-invalid' : '' }}" name="agencia_id" id="agencia_id" required>
                    @foreach($agencias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agencia_id') ? old('agencia_id') : $sucursal->agencia->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agencia'))
                    <span class="text-danger">{{ $errors->first('agencia') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.agencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zona_id">{{ trans('cruds.sucursal.fields.zona') }}</label>
<<<<<<< HEAD
                <select class="form-control select2 {{ $errors->has('zona') ? 'is-invalid' : '' }}" name="zona_id"
                    id="zona_id" required>
                    @foreach($zonas as $id => $entry)
                    <option value="{{ $id }}" {{ (old('zona_id') ? old('zona_id') : $sucursal->zona->id ?? '') == $id ?
                        'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zona'))
                <div class="invalid-feedback">
                    {{ $errors->first('zona') }}
                </div>
=======
                <select class="form-control select2 {{ $errors->has('zona') ? 'is-invalid' : '' }}" name="zona_id" id="zona_id" required>
                    @foreach($zonas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('zona_id') ? old('zona_id') : $sucursal->zona->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zona'))
                    <span class="text-danger">{{ $errors->first('zona') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.zona_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.sucursal.fields.entidad') }}</label>
<<<<<<< HEAD
                <select class="form-control {{ $errors->has('entidad') ? 'is-invalid' : '' }}" name="entidad"
                    id="entidad">
                    <option value disabled {{ old('entidad', null)===null ? 'selected' : '' }}>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Sucursal::ENTIDAD_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('entidad', $sucursal->entidad) === (string) $key ? 'selected' : ''
                        }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('entidad'))
                <div class="invalid-feedback">
                    {{ $errors->first('entidad') }}
                </div>
=======
                <select class="form-control {{ $errors->has('entidad') ? 'is-invalid' : '' }}" name="entidad" id="entidad">
                    <option value disabled {{ old('entidad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Sucursal::ENTIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('entidad', $sucursal->entidad) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('entidad'))
                    <span class="text-danger">{{ $errors->first('entidad') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.entidad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="municipio">{{ trans('cruds.sucursal.fields.municipio') }}</label>
<<<<<<< HEAD
                <input class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" type="text"
                    name="municipio" id="municipio" value="{{ old('municipio', $sucursal->municipio) }}">
                @if($errors->has('municipio'))
                <div class="invalid-feedback">
                    {{ $errors->first('municipio') }}
                </div>
=======
                <input class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" type="text" name="municipio" id="municipio" value="{{ old('municipio', $sucursal->municipio) }}">
                @if($errors->has('municipio'))
                    <span class="text-danger">{{ $errors->first('municipio') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.municipio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="direccion">{{ trans('cruds.sucursal.fields.direccion') }}</label>
<<<<<<< HEAD
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text"
                    name="direccion" id="direccion" value="{{ old('direccion', $sucursal->direccion) }}">
                @if($errors->has('direccion'))
                <div class="invalid-feedback">
                    {{ $errors->first('direccion') }}
                </div>
=======
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" value="{{ old('direccion', $sucursal->direccion) }}">
                @if($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.direccion_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.sucursal.fields.estatus') }}</label>
                @foreach(App\Models\Sucursal::ESTATUS_RADIO as $key => $label)
<<<<<<< HEAD
                <div class="form-check {{ $errors->has('estatus') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="estatus_{{ $key }}" name="estatus"
                        value="{{ $key }}" {{ old('estatus', $sucursal->estatus) === (string) $key ? 'checked' : '' }}
                    required>
                    <label class="form-check-label" for="estatus_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('estatus'))
                <div class="invalid-feedback">
                    {{ $errors->first('estatus') }}
                </div>
=======
                    <div class="form-check {{ $errors->has('estatus') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="estatus_{{ $key }}" name="estatus" value="{{ $key }}" {{ old('estatus', $sucursal->estatus) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="estatus_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('estatus'))
                    <span class="text-danger">{{ $errors->first('estatus') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.sucursal.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
<<<<<<< HEAD
                <button class="btn btn-success" type="submit">
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