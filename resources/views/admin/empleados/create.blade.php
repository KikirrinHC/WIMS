@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.empleado.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.empleados.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="clave">{{ trans('cruds.empleado.fields.clave') }}</label>
                <input class="form-control {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="text" name="clave" id="clave" value="{{ old('clave', '') }}" required>
                @if($errors->has('clave'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clave') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.clave_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombre">{{ trans('cruds.empleado.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sucursal_id">{{ trans('cruds.empleado.fields.sucursal') }}</label>
                <select class="form-control select2 {{ $errors->has('sucursal') ? 'is-invalid' : '' }}" name="sucursal_id" id="sucursal_id" required>
                    @foreach($sucursals as $id => $entry)
                        <option value="{{ $id }}" {{ old('sucursal_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sucursal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sucursal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.sucursal_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection