<?php

use App\Http\Controllers\Admin\InventarioprincipalController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Empresa
    Route::delete('empresas/destroy', 'EmpresaController@massDestroy')->name('empresas.massDestroy');
    Route::post('empresas/media', 'EmpresaController@storeMedia')->name('empresas.storeMedia');
    Route::post('empresas/ckmedia', 'EmpresaController@storeCKEditorImages')->name('empresas.storeCKEditorImages');
    Route::resource('empresas', 'EmpresaController');

    // Agencia
    Route::delete('agencia/destroy', 'AgenciaController@massDestroy')->name('agencia.massDestroy');
    Route::resource('agencia', 'AgenciaController');

    // Zonas
    Route::delete('zonas/destroy', 'ZonasController@massDestroy')->name('zonas.massDestroy');
    Route::resource('zonas', 'ZonasController');

    // Sucursal
    Route::delete('sucursals/destroy', 'SucursalController@massDestroy')->name('sucursals.massDestroy');
    Route::resource('sucursals', 'SucursalController');

    // Cat Tiposprendas
    Route::delete('cat-tiposprendas/destroy', 'CatTiposprendasController@massDestroy')->name('cat-tiposprendas.massDestroy');
    Route::resource('cat-tiposprendas', 'CatTiposprendasController');

    // Cat Tallas
    Route::delete('cat-tallas/destroy', 'CatTallasController@massDestroy')->name('cat-tallas.massDestroy');
    Route::resource('cat-tallas', 'CatTallasController');

    // Inventarioprincipal
    Route::delete('inventarioprincipals/destroy', 'InventarioprincipalController@massDestroy')->name('inventarioprincipals.massDestroy');
    Route::get('inventarioprincipals/edit/{id}/{tipo}', 'InventarioprincipalController@edit')->name('inventarioprincipals.edit');
    Route::put('inventarioprincipals/update/{id}/{tipo}', 'InventarioprincipalController@update')->name('inventarioprincipals.update');
    Route::get('inventarioprincipals/transfer/{id}', 'InventarioprincipalController@transfer')->name('inventarioprincipals.transfer');
    Route::put('inventarioprincipals/transfer/{id}', 'InventarioprincipalController@updateTransferToAlmacen')->name('inventarioprincipals.updateTransferToAlmacen');

    Route::resource('inventarioprincipals', 'InventarioprincipalController')->except([
        'update', 'edit'
    ]);

    // Inventarioprincipal_audit
    Route::resource('inventarioprincipals_audit', 'InventarioprincipalAuditController');

    // Prendas
    Route::resource('prendas', 'PrendasController');



    // Almacenes
    Route::delete('almacenes/destroy', 'AlmacenesController@massDestroy')->name('almacenes.massDestroy');
    Route::get('almacenes/{id}', 'AlmacenesController@show')->name('almacenes.show');
    Route::get('almacenes/edit/{id}/{tipo}', 'AlmacenesController@edit')->name('almacenes.edit');
    Route::put('almacenes/update/{id}/{tipo}', 'AlmacenesController@update')->name('almacenes.update');
    Route::get('almacenes/devolucion/{id}', 'AlmacenesController@devolucion')->name('almacenes.devolucion');
    Route::put('almacenes/devolucion/{id}', 'AlmacenesController@updateDevolucionToInventario')->name('almacenes.updateDevolucionToInventario');

    Route::get('almacenes/transfer/{id}', 'AlmacenesController@transfer')->name('almacenes.transfer');
    Route::put('almacenes/transfer/{id}', 'AlmacenesController@updateTransferBetweenAlmacenes')->name('almacenes.updateTransferToAlmacen');
    Route::get('almacenes/populate/{id}', 'AlmacenesController@populateAlmacenes')->name('almacenes.populate');

    Route::resource('almacenes', 'AlmacenesController')->except([
        'show', 'update', 'edit'
    ]);

    // Asignaciones
    Route::delete('asignaciones/destroy', 'AsignacionesController@massDestroy')->name('asignaciones.massDestroy');
    //Route::get('asignaciones/edit/{id}', 'AsignacionesController@edit')->name('asignaciones.edit');
    //Route::put('asignaciones/update/{id}', 'AsignacionesController@update')->name('asignaciones.update');
    Route::get('asignaciones/change/{id}', 'AsignacionesController@cambio')->name('asignaciones.change');
    Route::put('asignaciones/change/{id}', 'AsignacionesController@updateCambio')->name('asignaciones.updateChange');

    Route::resource('asignaciones', 'AsignacionesController')->except([
        //    'update', 'edit'
    ]);


    // Empleados
    Route::delete('empleados/destroy', 'EmpleadosController@massDestroy')->name('empleados.massDestroy');
    Route::post('empleados/parse-csv-import', 'EmpleadosController@parseCsvImport')->name('empleados.parseCsvImport');
    Route::post('empleados/process-csv-import', 'EmpleadosController@processCsvImport')->name('empleados.processCsvImport');
    Route::resource('empleados', 'EmpleadosController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
/*
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    // Asignaciones
    Route::apiResource('asignaciones', 'AsignacionesApiController');

    // Empleados
    Route::apiResource('empleados', 'EmpleadosApiController');
});
*/