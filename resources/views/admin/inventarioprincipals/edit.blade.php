@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.inventarioprincipal.title') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.inventarioprincipals.update', [$inventario->id, $tipo]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Cantidad actual: {{ $inventario->cantidad }}
                prendas</label>
            @if ($tipo=='add')
            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a añadir:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea agregar</span>
            </div>
            <div class="form-group">
                <label class="" for="descripcion">Comentario</label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" value=""></textarea>
                <span class="help-block">Indique una descripción por la cual agrega las prendas</span>
            </div>
            @elseif ($tipo=='substract')
            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a descontar:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea descontar</span>
            </div>
            <div class="form-group">
                <label class="required" for="descripcion">Comentario</label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" value=""
                    required></textarea>
                <span class="help-block">Indique una descripción por la cual agrega las prendas</span>
            </div>
            @endif
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection