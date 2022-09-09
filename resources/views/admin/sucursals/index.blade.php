@extends('layouts.admin')
@section('content')
@can('sucursal_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.sucursals.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.sucursal.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sucursal.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sucursal">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.sucursal.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.sucursal.fields.agencia') }}
                        </th>
                        <th>
                            {{ trans('cruds.sucursal.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursals as $key => $sucursal)
                    <tr data-entry-id="{{ $sucursal->id }}">

                        <td>
                            {{ $sucursal->nombre ?? '' }}
                        </td>
                        <td>
                            {{ $sucursal->agencia->nombre ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Sucursal::ESTATUS_RADIO[$sucursal->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('sucursal_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.sucursals.show', $sucursal->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('sucursal_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.sucursals.edit', $sucursal->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('sucursal_delete')
                            <form action="{{ route('admin.sucursals.destroy', $sucursal->id) }}" method="POST"
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
            order: [[0, 'asc']],
            pageLength: 10,
        });
        let table = $('.datatable-Sucursal:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection