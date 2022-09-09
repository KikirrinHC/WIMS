@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.inventarioprincipal.title') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.inventarioprincipals.update', [$inventarioprincipal->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Cantidad actual: {{ $inventarioprincipal->cantidad }}
                prendas</label>
            {{$tipo}}
            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a añadir:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea agregar</span>
            </div>

            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a añadir:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea agregar</span>
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