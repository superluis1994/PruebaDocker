<?php

namespace Routes;

use Core\Route;
use Core\Utils;


Route::group('/panel', function () {
    // Route::get('', "PanelControllers@home");
    Route::get('/home', "PanelControllers@home");
    // Route::get('/home/', "PanelControllers@home");
    Route::get('/asig/sorto', "PanelControllers@home");
    Route::get('/inicio', "PanelControllers@home");
    Route::get('/salir', "PanelControllers@cerrarSesion");
    Route::get('/entrada/add', "PanelControllers@addEntrada");
    // Route::get('/cliente/add', "ClienteControllers@addCliente");
    // Route::get('/marcas/list', "ClienteControllers@SelectMarcas");

});

Route::group('/panel/factura', function () {
    Route::get('/registrar', "FacturaControllers@Registrar_factura");
});
Route::group('/panel/cliente', function () {
    Route::get('/add', "ClienteControllers@addCliente");
    Route::get('/listado', "ClienteControllers@listClientes");
    Route::get('/busqueda', "ClienteControllers@BusquedasYpaginacion");
    Route::get('/paginacion', "ClienteControllers@BusquedasYpaginacion");
    Route::get('/select', "PanelControllers@SelectCliente");
});
Route::group('/panel/marcas', function () {
    Route::get('/list', "ClienteControllers@SelectMarcas");
});
Route::group('/panel/vehiculo', function () {
    Route::get('/list', "VehiculoControllers@SelectVehiculo");
});
Route::group('/panel/Administracion/servicios', function () {
    Route::get('', "ServiciosControllers@home");
    Route::get('/', "ServiciosControllers@home");
    Route::get('/id', "ServiciosControllers@ServiciosId");
    Route::get('/update', "ServiciosControllers@update");
    Route::get('/busqueda', "ServiciosControllers@BusquedasYpaginacion");
    Route::get('/paginacion', "ServiciosControllers@BusquedasYpaginacion");
});
Route::group('/panel/Administracion/marca', function () {
    Route::get('', "MarcasControllers@home");
    Route::get('/', "MarcasControllers@home");
    Route::get('/add', "MarcasControllers@create");
    Route::get('/id', "MarcasControllers@MarcaId");
    Route::get('/update', "MarcasControllers@update");
    Route::get('/busqueda', "MarcasControllers@BusquedasYpaginacion");
    Route::get('/paginacion', "MarcasControllers@BusquedasYpaginacion");
});
Route::group('/factura/pdf', function () {
    Route::get('/{id}', "FacturaControllers@pdf");
});













Route::group('/panel/privilegios', function () {

    Route::get('/lsJovenes', "ListJovenesControllers@home");
    // Route::get('', "AsistenciaControllers@home");
    // Route::get('Miasistencia', "AsistenciaControllers@home");
});
Route::group('/panel/adm/ventas', function () {

    Route::get('', "ventaControllers@home");
    Route::get('/', "ventaControllers@home");
});
Route::group('/panel/adm/rifas', function () {

    Route::get('', "rifaControllers@home");
    Route::get('/', "rifaControllers@home");
});
Route::group('/panel/adm/talento', function () {
    Route::get('', "TalentoControllers@home");
    Route::get('/', "TalentoControllers@home");
    Route::get('/add', "TalentoControllers@home");
    Route::post('/tipo/{tipo}', "TalentoControllers@home");
    Route::post('/paginacion', "TalentoControllers@home");
});
