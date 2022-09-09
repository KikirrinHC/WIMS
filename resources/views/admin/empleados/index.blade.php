@extends('layouts.admin')
@section('content')
@can('empleado_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.empleados.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.empleado.title_singular') }}
        </a>
        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
            {{ trans('global.app_csvImport') }}
        </button>
        @include('csvImport.modal', ['model' => 'Empleado', 'route' => 'admin.empleados.parseCsvImport'])
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.empleado.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Empleado">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.empleado.fields.clave') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.sucursal') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($empleados as $key => $empleado)
                    <tr data-entry-id="{{ $empleado->id }}">

                        <td>
                            {{ $empleado->clave ?? '' }}
                        </td>
                        <td>
                            {{ $empleado->nombre ?? '' }}
                        </td>
                        <td>
                            {{ $empleado->sucursal->nombre ?? '' }}
                        </td>
                        <td>
                            @can('empleado_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.empleados.show', $empleado->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('empleado_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.empleados.edit', $empleado->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('empleado_delete')
                            <form action="{{ route('admin.empleados.destroy', $empleado->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-md btn-danger"
                                    value="{{ trans('global.delete') }}"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
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
            order: [[1, 'asc']],
            pageLength: 10,
        });
        let table = $('.datatable-Empleado:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection