@extends('layouts.admin')
@section('content')
@can('cat_tiposprenda_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.cat-tiposprendas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.catTiposprenda.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.catTiposprenda.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CatTiposprenda">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.catTiposprenda.fields.tipo') }}
                        </th>
                        <th>
                            {{ trans('cruds.catTiposprenda.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catTiposprendas as $key => $catTiposprenda)
                    <tr data-entry-id="{{ $catTiposprenda->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $catTiposprenda->tipo ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\CatTiposprenda::ESTATUS_RADIO[$catTiposprenda->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('cat_tiposprenda_show')
                            <a class="btn btn-md btn-primary"
                                href="{{ route('admin.cat-tiposprendas.show', $catTiposprenda->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('cat_tiposprenda_edit')
                            <a class="btn btn-md btn-info"
                                href="{{ route('admin.cat-tiposprendas.edit', $catTiposprenda->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('cat_tiposprenda_delete')
                            <form action="{{ route('admin.cat-tiposprendas.destroy', $catTiposprenda->id) }}"
                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
        let table = $('.datatable-CatTiposprenda:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection