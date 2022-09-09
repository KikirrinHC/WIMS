@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.inventarioprincipal.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-InventarioResumen">
                <thead>
                    <tr>
                        @php

                        $resumen=$inventarioppal->resumen;
                        @endphp
                        @foreach($resumen as $key => $inv)
                        <th>
                            {{$key ?? ''}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($resumen as $key => $inv)
                        <td>
                            {{$inv ?? ''}}
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Detalle de existencias
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-InventarioPrincipal">
                <thead>
                    <tr>
                        <th>
                            Tipo de prenda
                        </th>
                        <th>
                            Talla
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $inventario=$inventarioppal->detalles;
                    @endphp
                    @foreach($inventario as $key => $inv)
                    <tr data-entry-id="{{ $inv->id }}">

                        <td>
                            {{ $inv->tipo ?? '' }}
                        </td>
                        <td>
                            {{ $inv->talla ?? '' }}
                        </td>
                        <td>
                            {{ $inv->cantidad ?? '' }}

                        </td>
                        <td>
                            @can('inventarioprincipal_edit')
                            <a class="btn btn-md btn-success"
                                href="{{ route('admin.inventarioprincipals.edit', [$inv->id, 'add']) }}">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                            <a class="btn btn-md btn-danger"
                                href="{{ route('admin.inventarioprincipals.edit', [$inv->id, 'substract']) }}">
                                <i class="fa-solid fa-circle-minus"></i>
                            </a>
                            @endcan
                            @can('inventarioprincipal_transfer')
                            @if($inv->cantidad > 0)
                            <a class="btn btn-md btn-info"
                                href="{{ route('admin.inventarioprincipals.transfer', [$inv->id]) }}">
                                <i class="fa-solid fa-angles-right"></i> </a>
                            @endif
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[0, 'asc']],
            pageLength: 10,
        });
        let table = $('.datatable-InventarioPrincipal:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection