<?php
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
});
