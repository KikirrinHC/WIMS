<<<<<<< HEAD
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
=======
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('estructura_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/empresas*") ? "menu-open" : "" }} {{ request()->is("admin/agencia*") ? "menu-open" : "" }} {{ request()->is("admin/sucursals*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.estructura.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('empresa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.empresas.index") }}" class="nav-link {{ request()->is("admin/empresas") || request()->is("admin/empresas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.empresa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('agencium_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agencia.index") }}" class="nav-link {{ request()->is("admin/agencia") || request()->is("admin/agencia/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agencium.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sucursal_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sucursals.index") }}" class="nav-link {{ request()->is("admin/sucursals") || request()->is("admin/sucursals/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sucursal.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('catalogo_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/zonas*") ? "menu-open" : "" }} {{ request()->is("admin/cat-tiposprendas*") ? "menu-open" : "" }} {{ request()->is("admin/cat-tallas*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.catalogo.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('zona_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.zonas.index") }}" class="nav-link {{ request()->is("admin/zonas") || request()->is("admin/zonas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marked-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.zona.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('cat_tiposprenda_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cat-tiposprendas.index") }}" class="nav-link {{ request()->is("admin/cat-tiposprendas") || request()->is("admin/cat-tiposprendas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.catTiposprenda.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('cat_talla_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cat-tallas.index") }}" class="nav-link {{ request()->is("admin/cat-tallas") || request()->is("admin/cat-tallas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.catTalla.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
