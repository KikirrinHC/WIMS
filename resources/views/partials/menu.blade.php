<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h6" style="margin-bottom: 0;" href="{{ route('admin.home') }}">
            {{auth()->user()->name}}
        </a>
    </div>

    <ul class="c-sidebar-nav">


        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link {{ request()->is("
                admin/home") || request()->is("admin/home/*") ? "c-active" : "" }}">
                <i class="fa-solid fa-chart-line  c-sidebar-nav-icon"></i>
                Dashboard
            </a>
        </li>

        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/user-alerts/*") ? "c-show" : "" }} {{ request()->
            is("admin/messenger/*") ? "c-show" : "" }} {{ request()->is("profile/password/*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-user-circle c-sidebar-nav-icon">

                </i>
                Mi perfil
            </a>
           
			<ul class="c-sidebar-nav-dropdown-items">
               
			   @can('user_alert_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.user-alerts.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.userAlert.title') }}
                    </a>
                </li>
                @endcan

                @php($unread = \App\Models\QaTopic::unreadCount())
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.messenger.index') }}" class="{{ request()->is(" admin/messenger") ||
                        request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                        <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                        @endif

                    </a>
                </li>
			
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                        href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
                @endcan
                @endif

            </ul>
			
        </li>


        @can('estructura_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/empresas*") ? "c-show" : "" }} {{ request()->
            is("admin/agencia*") ? "c-show" : "" }} {{ request()->is("admin/sucursals*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.estructura.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('empresa_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.empresas.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/empresas") || request()->is("admin/empresas/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.empresa.title') }}
                    </a>
                </li>
                @endcan
                @can('agencium_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.agencia.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/agencia") || request()->is("admin/agencia/*") ? "c-active" : "" }}">
                        <i class="fa-fw far fa-building c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.agencium.title') }}
                    </a>
                </li>
                @endcan
                @can('sucursal_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.sucursals.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/sucursals") || request()->is("admin/sucursals/*") ? "c-active" : "" }}">
                        <i class="fa-fw far fa-building c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.sucursal.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('inventario_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/inventarioprincipals*") ? "c-show" : "" }} {{
            request()->is("admin/almacenes*") ? "c-show" : "" }}{{
            request()->is("admin/prendas*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cubes c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.inventario.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('inventarioprincipal_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.inventarioprincipals.index') }}"
                        class="c-sidebar-nav-link {{ request()->is(" admin/inventarioprincipals") ||
                        request()->is("admin/inventarioprincipals/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.inventarioprincipal.title') }}
                    </a>
                </li>
                @endcan
                @can('almacen_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.almacenes.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/almacenes") || request()->is("admin/almacenes/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.almacen.title') }}
                    </a>
                </li>
                @endcan
				@can('prenda_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.prendas.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/prendas") || request()->is("admin/prendas/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                        </i>
                        Prendas
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('asignacion_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.asignaciones.index') }}" class="c-sidebar-nav-link {{ request()->is("
                admin/asignaciones") || request()->is("admin/asignaciones/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-user-check c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.asignacion.title') }}
            </a>
        </li>
        @endcan
        @can('catalogo_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/zonas*") ? "c-show" : "" }} {{ request()->
            is("admin/cat-tiposprendas*") ? "c-show" : "" }} {{ request()->is("admin/cat-tallas*") ? "c-show" : "" }} {{
            request()->is("admin/empleados*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.catalogo.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('zona_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.zonas.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/zonas") || request()->is("admin/zonas/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.zona.title') }}
                    </a>
                </li>
                @endcan
                @can('cat_tiposprenda_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.cat-tiposprendas.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/cat-tiposprendas") || request()->is("admin/cat-tiposprendas/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.catTiposprenda.title') }}
                    </a>
                </li>
                @endcan
                @can('cat_talla_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.cat-tallas.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/cat-tallas") || request()->is("admin/cat-tallas/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.catTalla.title') }}
                    </a>
                </li>
                @endcan
                @can('empleado_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.empleados.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/empleados") || request()->is("admin/empleados/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.empleado.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('user_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/permissions*") ? "c-show" : "" }} {{ request()->
            is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{
            request()->is("admin/audit-logs*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                @endcan
                @can('user_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                @endcan
                @can('audit_log_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.audit-logs.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.auditLog.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('faq_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/faq-categories*") ? "c-show" : "" }} {{ request()->
            is("admin/faq-questions*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.faqManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('faq_category_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.faq-categories.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.faqCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('faq_question_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.faq-questions.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.faqQuestion.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

    </ul>
	<div class="c-sidebar-footer d-md-down-none">
        <span>by Smart Uniforms</span>
    </div>
</div>
