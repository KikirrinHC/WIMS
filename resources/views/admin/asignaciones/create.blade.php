@extends('layouts.admin')
@section('content')
@php
echo("<pre>");
    //print_r($sucursales);
    echo("</pre>");
@endphp
<div id="errorMessage">
    @isset($message)
    @if(count((array)$message) > 1)

    <div class="alert alert-{{$message->type}} alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">{{$message->title}}</h4>
        <p>{{$message->msj}}</p>
    </div>


    @endif
    @endisset
</div>
@if ( $sucursales->count()==0 )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">No se encontraron empleados</h4>
    <p>Verifique que ha registrado empleados y que tienen una sucursal asignada.</p>
    <a class="btn btn-md btn-warning" href="{{ route('admin.empleados.index')}}">
        Ir al catálogo de empleados
    </a>
</div>

@else


<div class="card">
    <div class="card-header">
        Asignar prenda
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.asignaciones.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="sucursals_id">Sucursal</label>
                <select class="form-control {{ $errors->has('sucursal') ? 'is-invalid' : '' }}" name="sucursals_id"
                    id="sucursals_id" required>
                    <option value="" selected>Seleccione...</option>
                    @foreach($sucursales as $id => $entry)
                    <option value="{{ $entry->id }}">
                        {{ $entry->nombre }}</option>
                    @endforeach
                </select>
                @if($errors->has('sucursal'))
                <div class="invalid-feedback">
                    {{ $errors->first('sucursal') }}
                </div>
                @endif
                <span class="help-block">Seleccione la sucuresal del empleado</span>
            </div>
            <div class="form-group">
                <label class="required" for="empleado_id">{{ trans('cruds.asignacion.fields.empleado') }}</label>
                <select disabled class="form-control {{ $errors->has('empleado') ? 'is-invalid' : '' }}"
                    name="empleado_id" id="empleado_id" required>
                    <option value="" selected>Seleccione...</option>
                </select>
                @if($errors->has('empleado'))
                <div class="invalid-feedback">
                    {{ $errors->first('empleado') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.asignacion.fields.empleado_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cat_tiposprendas_id">Tipo de prenda:</label>
                <select disabled class="form-control {{ $errors->has('prenda') ? 'is-invalid' : '' }}"
                    name="cat_tiposprendas_id" id="cat_tiposprendas_id" required>
                    <option value="" selected>Seleccione...</option>
                </select>
                @if($errors->has('prenda'))
                <div class="invalid-feedback">
                    {{ $errors->first('prenda') }}
                </div>
                @endif
                <span class="help-block">Seleccione un tipo de prenda</span>
            </div>
            <div class="form-group">
                <label class="required" for="cat_tallas_id">Talla:</label>
                <select disabled class="form-control {{ $errors->has('talla') ? 'is-invalid' : '' }}"
                    name="cat_tallas_id" id="cat_tallas_id" required>

                </select>
                @if($errors->has('talla'))
                <div class="invalid-feedback">
                    {{ $errors->first('talla') }}
                </div>
                @endif
                <span class="help-block">Seleccione una talla de la prenda</span>
            </div>
            <div class="form-group">
                <label class="required" for="qr">{{ trans('cruds.asignacion.fields.qr') }}</label>
                <input class="form-control {{ $errors->has('qr') ? 'is-invalid' : '' }}" type="text" name="qr" id="qr"
                    value="{{ old('qr', '') }}" required>
                @if($errors->has('qr'))
                <div class="invalid-feedback">
                    {{ $errors->first('qr') }}
                </div>
                @endif
                <span class="help-block">Indique el QR de la prenda</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            <input type="hidden" id="descripcion" name="descripcion" value="Asignación">
        </form>


    </div>
</div>

@endif


@endsection
@section('scripts')
@parent
<script>

    $("#sucursals_id").change(function () {
        $("#errorMessage").html("");
        $("#cat_tallas_id").html("");
        $("#cat_tallas_id").attr("disabled", "disabled");
        if ($("#sucursals_id").val() == "") {
            $("#empleado_id").html("");
            $("#empleado_id").attr("disabled", "disabled");
            $("#cat_tiposprendas_id").html("");
            $("#cat_tiposprendas_id").attr("disabled", "disabled");

        } else {

            $.ajax({
                type: 'GET',
                url: '/api/v1/asignaciones/empleados/' + $("#sucursals_id").val(),
                success: function (resultado) {
                    if (resultado.length == 0) {

                        $("#errorMessage").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><h4 class="alert-heading">Error</h4><p>No hay empleados asignados a la sucursal elegida</p></div>');
                    } else {
                        $("#empleado_id").html("");
                        $("#empleado_id").attr("disabled", "disabled");
                        $("#empleado_id").append('<option value="" selected>Seleccione...</option>');
                        for (var i = 0; i < resultado.length; i++) {
                            $("#empleado_id").append('<option value="' + resultado[i]["id"] + '">' + resultado[i]["clave"] + ' - ' + resultado[i]["nombre"] + '</option>');
                        }
                        $("#empleado_id").removeAttr("disabled");
                    }
                },
                error: function (resultado) { alert("Ocurrió un error inesperado") }
            });

            $.ajax({
                type: 'GET',
                url: '/api/v1/asignaciones/tiposprendas/' + $("#sucursals_id").val(),
                success: function (resultado) {
                    if (resultado.length == 0) {

                        $("#errorMessage").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><h4 class="alert-heading">Error</h4><p>No hay prendas en el almacén de la sucursal elegida</p></div>');
                    } else {
                        //console.log(resultado);
                        $("#cat_tiposprendas_id").html("");
                        $("#cat_tiposprendas_id").attr("disabled", "disabled");
                        $("#cat_tiposprendas_id").append('<option value="" selected>Seleccione...</option>');
                        for (var i = 0; i < resultado.length; i++) {
                            $("#cat_tiposprendas_id").append('<option value="' + resultado[i]["id"] + '">' + resultado[i]["tipo"] + '</option>');
                        }
                        $("#cat_tiposprendas_id").removeAttr("disabled");
                    }
                },
                error: function (resultado) { alert("Ocurrió un error inesperado") }
            });
        }

    });

    $("#cat_tiposprendas_id").change(function () {

        $("#errorMessage").html("");
        if ($("#cat_tiposprendas_id").val() == "") {
            $("#cat_tallas_id").html("");
            $("#cat_tallas_id").attr("disabled", "disabled");
        } else {

            $.ajax({
                type: 'GET',
                url: '/api/v1/asignaciones/tallas/' + $("#sucursals_id").val() + '/' + $("#cat_tiposprendas_id").val(),
                success: function (resultado) {
                    if (resultado.length == 0) {
                        $("#errorMessage").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><h4 class="alert-heading">Error</h4><p>No hay tallas de la prenda seleccionada en el almacén de la sucursal elegida</p></div>');
                    } else {
                        $("#cat_tallas_id").html("");
                        $("#cat_tallas_id").attr("disabled", "disabled");
                        $("#cat_tallas_id").append('<option value="" selected>Seleccione...</option>');
                        for (var i = 0; i < resultado.length; i++) {
                            $("#cat_tallas_id").append('<option value="' + resultado[i]["id"] + '">' + resultado[i]["talla"] + '</option>');
                        }
                        $("#cat_tallas_id").removeAttr("disabled");
                    }
                },
                error: function (resultado) { alert("Ocurrió un error inesperado") }
            });
        }
    });




</script>
@endsection