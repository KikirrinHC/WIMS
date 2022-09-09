<?php
<<<<<<< HEAD
//Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    // Asignaciones
    Route::apiResource('asignaciones', 'AsignacionesApiController');
    Route::get('asignaciones/empleado/{id}', 'AsignacionesApiController@getEmpleado');
    Route::get('asignaciones/empleados/{id}', 'AsignacionesApiController@getEmpleadosPorSucursal');
    Route::get('asignaciones/tiposprendas/{id}', 'AsignacionesApiController@getTiposPrendasPorSucursal');
    Route::get('asignaciones/tallas/{idSucursal}/{idPrenda}', 'AsignacionesApiController@getTallasPorTipoPrenda');
    Route::get('asignaciones/prendadisponible/{id}/{talla}', 'AsignacionesApiController@disponibilidadPrenda');
    Route::get('asignaciones/tallasdisponibles/{id}/{talla}', 'AsignacionesApiController@disponibilidadTallas');

    //Dashboard
    Route::get('dashboard/inventarios', 'DashboardApiController@inventarios');
    Route::get('dashboard/empleados', 'DashboardApiController@empleados');
    Route::get('dashboard/prendas', 'DashboardApiController@prendas');
    Route::get('dashboard/tallasasignadasgraph/{orden}', 'DashboardApiController@tallasAsignadasGraph');


    // Empleados
    Route::apiResource('empleados', 'EmpleadosApiController');
=======

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Empresa
    Route::post('empresas/media', 'EmpresaApiController@storeMedia')->name('empresas.storeMedia');
    Route::apiResource('empresas', 'EmpresaApiController');

    // Agencia
    Route::apiResource('agencia', 'AgenciaApiController');

    // Zonas
    Route::apiResource('zonas', 'ZonasApiController');

    // Sucursal
    Route::apiResource('sucursals', 'SucursalApiController');

    // Cat Tiposprendas
    Route::apiResource('cat-tiposprendas', 'CatTiposprendasApiController');

    // Cat Tallas
    Route::apiResource('cat-tallas', 'CatTallasApiController');
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
});
