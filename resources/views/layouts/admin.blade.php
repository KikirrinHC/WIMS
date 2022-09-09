<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/50b47c0ef7.js" crossorigin="anonymous"></script>
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

    --}}
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
      rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
  </head>

  <body class="c-app">
    @include('partials.menu')
    <div class="c-wrapper">
      <header class="c-header c-header-fixed px-3">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
          data-class="c-sidebar-show">
          <i class="fas fa-fw fa-bars"></i>
        </button>

        <a class="c-header-brand d-lg-none" href="{{ route('admin.home') }}">{{auth()->user()->name}}</a>

        <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">
          <i class="fas fa-fw fa-bars"></i>
        </button>

        <ul class="c-header-nav ml-auto">
          @if(count(config('panel.available_languages', [])) > 1)
          <li class="c-header-nav-item dropdown d-md-down-none">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
              aria-expanded="false">
              {{ strtoupper(app()->getLocale()) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              @foreach(config('panel.available_languages') as $langLocale => $langName)
              <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{
                strtoupper($langLocale) }} ({{ $langName }})</a>
              @endforeach
            </div>
          </li>
          @endif

          <ul class="c-header-nav ml-auto">
            <li class="c-header-nav-item dropdown notifications-menu">
              <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                <i class="far fa-bell"></i>
                @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                @if($alertsCount > 0)
                <span class="badge badge-warning navbar-badge">
                  {{ $alertsCount }}
                </span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at',
                'ASC')->get()->reverse()) > 0)
                @foreach($alerts as $alert)
                <div class="dropdown-item">
                  <a href="{{ $alert->alert_link ? $alert->alert_link : " #" }}" target="_blank"
                    rel="noopener noreferrer">
                    @if($alert->pivot->read === 0) <strong> @endif
                      {{ $alert->alert_text }}
                      @if($alert->pivot->read === 0) </strong> @endif
                  </a>
                </div>
                @endforeach
                @else
                <div class="text-center">
                  {{ trans('global.no_alerts') }}
                </div>
                @endif
              </div>
            </li>
            <li class="c-header-nav-item">
              <a href="#" class="c-header-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-header-nav-icon fas fa-fw fa-sign-out-alt">

                </i>

              </a>
            </li>
          </ul>

        </ul>
      </header>

      <div class="c-body">
        <main class="c-main">


          <div class="container-fluid">
            @if(session('message'))
            <div class="row mb-2">
              <div class="col-lg-12">
                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
              </div>
            </div>
            @endif
            @if($errors->count() > 0)
            <div class="alert alert-danger">
              <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            @yield('content')

          </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
      <div>
        <footer class="footer">
          <div>
            &nbsp;
          </div>
          <div>
            <span>Warehouses and Inventory Management System (WIMS) ©</span>
          </div>
        </footer>
      </div>
    </div>

    <!---SCRIPTS PARA LAS GRÁFICAS CON HIGHCHARTS-->

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!---END-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
      $(function () {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

        let languages = {
          'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
          language: {
            url: languages['{{ app()->getLocale() }}']
          },
          /*columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
          }, {
            orderable: false,
            searchable: false,
            targets: -1
          }],
          
          select: {
            style: 'multi+shift',
            selector: 'td:first-child'
          },*/
          order: [],
          scrollX: true,
          pageLength: 100,
          dom: 'lBfrtip<"actions">',
          buttons: [
            /*{
              extend: 'selectAll',
              className: 'btn-primary',
              text: selectAllButtonTrans,
              exportOptions: {
                columns: ':visible'
              },
              action: function (e, dt) {
                e.preventDefault()
                dt.rows().deselect();
                dt.rows({ search: 'applied' }).select();
              }
            },
            {
              extend: 'selectNone',
              className: 'btn-primary',
              text: selectNoneButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'copy',
              className: 'btn-default',
              text: copyButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'csv',
              className: 'btn-default',
              text: csvButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },*/
            {
              extend: 'excel',
              className: 'btn-default',
              text: excelButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'pdf',
              className: 'btn-default',
              text: pdfButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'print',
              className: 'btn-default',
              text: printButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            /* {
               extend: 'colvis',
               className: 'btn-default',
               text: colvisButtonTrans,
               exportOptions: {
                 columns: ':visible'
               }
             }*/
          ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
      });

    </script>
    <script>
      $(document).ready(function () {
        $(".notifications-menu").on('click', function () {
          if (!$(this).hasClass('open')) {
            $('.notifications-menu .label-warning').hide();
            $.get('/admin/user-alerts/read');
          }
        });
      });

    </script>
    @yield('scripts')
  </body>

</html>