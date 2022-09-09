@extends('layouts.admin')
@section('content')
@php
echo("<pre>");
    // print_r($asignacion);
    echo("</pre>");
@endphp
<div class="card">
    <div class="card-header">
        Editar asignación
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.asignaciones.update', [$asignacion->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label class="required" for="qr">{{ trans('cruds.asignacion.fields.qr') }}</label>
                <input class="form-control {{ $errors->has('qr') ? 'is-invalid' : '' }}" type="text" name="qr" id="qr"
                    value="{{ old('qr', $asignacion->qr) }}" required>
                @if($errors->has('qr'))
                <div class="invalid-feedback">
                    {{ $errors->first('qr') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.asignacion.fields.qr_helper') }}</span>
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