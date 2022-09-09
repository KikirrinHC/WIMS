@can('cat_talla_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cat-tallas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.catTalla.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.catTalla.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-tipoprendaCatTallas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.catTalla.fields.tipoprenda') }}
                        </th>
                        <th>
                            {{ trans('cruds.catTalla.fields.talla') }}
                        </th>
                        <th>
                            {{ trans('cruds.catTalla.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catTallas as $key => $catTalla)
                        <tr data-entry-id="{{ $catTalla->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $catTalla->tipoprenda->tipo ?? '' }}
                            </td>
                            <td>
                                {{ $catTalla->talla ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CatTalla::ESTATUS_RADIO[$catTalla->estatus] ?? '' }}
                            </td>
                            <td>
                                @can('cat_talla_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cat-tallas.show', $catTalla->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cat_talla_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cat-tallas.edit', $catTalla->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cat_talla_delete')
                                    <form action="{{ route('admin.cat-tallas.destroy', $catTalla->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cat_talla_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cat-tallas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-tipoprendaCatTallas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection