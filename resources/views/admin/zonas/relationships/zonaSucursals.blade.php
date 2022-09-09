<<<<<<< HEAD
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
            <table class=" table table-bordered table-striped table-hover datatable datatable-zonaSucursals">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sucursal.fields.id') }}
                        </th>
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

                            </td>
                            <td>
                                {{ $sucursal->id ?? '' }}
                            </td>
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
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sucursals.show', $sucursal->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sucursal_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sucursals.edit', $sucursal->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sucursal_delete')
                                    <form action="{{ route('admin.sucursals.destroy', $sucursal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

=======
<div class="m-3">
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
                <table class=" table table-bordered table-striped table-hover datatable datatable-zonaSucursals">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.sucursal.fields.id') }}
                            </th>
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

                                </td>
                                <td>
                                    {{ $sucursal->id ?? '' }}
                                </td>
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
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.sucursals.show', $sucursal->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('sucursal_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.sucursals.edit', $sucursal->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('sucursal_delete')
                                        <form action="{{ route('admin.sucursals.destroy', $sucursal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sucursal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sucursals.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-zonaSucursals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection