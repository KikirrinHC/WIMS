@extends('layouts.admin')
@section('content')

@php
/*
echo("<pre>");
    print_r($almacenes);
    echo("</pre>");


echo("--------<pre>");
    print_r($almacen);
    echo("</pre>");
*/
@endphp
<div class="card">
    <div class="card-header">
        {{ trans('cruds.almacen.title') }} - Transferencias a otro almacén
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.almacenes.updateTransferToAlmacen', [$almacen->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Cantidad actual en almacén: {{ $almacen->cantidad }}
                prendas</label>

            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a transferir:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea transferir</span>
            </div>
            <div class="form-group">
                <label>Almacén que recibe</label>
                <select class="form-control" name="recibe" id="recibe">
                    <option value disabled>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach($almacenes as $key => $mialmacen)
                    @if ($almacen->sucursals_id!=$mialmacen->sucursals_id)
                    <option value="{{ $mialmacen->sucursals_id }}">{{ $mialmacen->nombre }}</option>
                    @endif
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Transferir
                </button>
            </div>
            <input type="hidden" value="{{$almacen->cat_tallas_id}}" name="cat_tallas_id">
            <input type="hidden" value="{{$almacen->cat_tiposprendas_id}}" name="cat_tiposprendas_id">
        </form>
    </div>
</div>



@endsection