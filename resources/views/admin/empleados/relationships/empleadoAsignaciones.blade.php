@can('asignacione_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.asignaciones.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.asignacione.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.asignacione.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-empleadoAsignaciones">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.asignacione.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.asignacione.fields.empleado') }}
                        </th>
                        <th>
                            {{ trans('cruds.asignacione.fields.qr') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaciones as $key => $asignacione)
                        <tr data-entry-id="{{ $asignacione->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $asignacione->id ?? '' }}
                            </td>
                            <td>
                                {{ $asignacione->empleado->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $asignacione->qr ?? '' }}
                            </td>
                            <td>
                                @can('asignacione_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.asignaciones.show', $asignacione->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('asignacione_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.asignaciones.edit', $asignacione->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('asignacione_delete')
                                    <form action="{{ route('admin.asignaciones.destroy', $asignacione->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('asignacione_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.asignaciones.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-empleadoAsignaciones:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection