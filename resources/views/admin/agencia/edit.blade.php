@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.agencium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.agencia.update', [$agencium->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">{{ trans('cruds.agencium.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre" value="{{ old('nombre', $agencium->nombre) }}" required>
                @if($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.agencium.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="empresa_id">{{ trans('cruds.agencium.fields.empresa') }}</label>
                <select class="form-control select2 {{ $errors->has('empresa') ? 'is-invalid' : '' }}" name="empresa_id"
                    id="empresa_id" required>
                    @foreach($empresas as $id => $entry)
                    <option value="{{ $id }}" {{ (old('empresa_id') ? old('empresa_id') : $agencium->empresa->id ?? '')
                        == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('empresa'))
                <div class="invalid-feedback">
                    {{ $errors->first('empresa') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.agencium.fields.empresa_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.agencium.fields.estatus') }}</label>
                @foreach(App\Models\Agencium::ESTATUS_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('estatus') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="estatus_{{ $key }}" name="estatus"
                        value="{{ $key }}" {{ old('estatus', $agencium->estatus) === (string) $key ? 'checked' : '' }}>
                    <label class="form-check-label" for="estatus_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('estatus'))
                <div class="invalid-feedback">
                    {{ $errors->first('estatus') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.agencium.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection