@extends('layouts.admin')
@section('content')
@can('user_alert_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-alerts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userAlert.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userAlert.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
<<<<<<< HEAD
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserAlert">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.alert_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.alert_link') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userAlerts as $key => $userAlert)
                        <tr data-entry-id="{{ $userAlert->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userAlert->id ?? '' }}
                            </td>
                            <td>
                                {{ $userAlert->alert_text ?? '' }}
                            </td>
                            <td>
                                {{ $userAlert->alert_link ?? '' }}
                            </td>
                            <td>
                                @foreach($userAlert->users as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $userAlert->created_at ?? '' }}
                            </td>
                            <td>
                                @can('user_alert_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-alerts.show', $userAlert->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('user_alert_delete')
                                    <form action="{{ route('admin.user-alerts.destroy', $userAlert->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
=======
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserAlert">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.userAlert.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAlert.fields.alert_text') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAlert.fields.alert_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAlert.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAlert.fields.created_at') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_alert_delete')
<<<<<<< HEAD
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
=======
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-alerts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
<<<<<<< HEAD
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
=======
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
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

<<<<<<< HEAD
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-UserAlert:not(.ajaxTable)').DataTable({ buttons: dtButtons })
=======
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.user-alerts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'alert_text', name: 'alert_text' },
{ data: 'alert_link', name: 'alert_link' },
{ data: 'user', name: 'users.name' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-UserAlert').DataTable(dtOverrideGlobals);
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
<<<<<<< HEAD
})
=======
});
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d

</script>
@endsection