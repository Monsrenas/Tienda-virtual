<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function () {
    return view('autenticacion.Funciones_login');
});

Route::get('pagina','KaizenController@pagina');





Route::get('ListaImagenes','KaizenController@getImageRelativePathsWfilenames');
Route::get('firebase','KaizenController@index');

Route::get('Leerbase','KaizenController@Leerbase');
Route::get('DevuelveBase','KaizenController@DevuelveBase');
Route::get('Info_Producto','KaizenController@Info_Producto');
Route::post('GuardaRegistro','KaizenController@GuardaRegistro');

Route::get('Vista','KaizenController@Vista');

Route::get('CarritoAgregarItem','KaizenController@CarritoAgregarItem');
Route::get('CarritoEliminaItem','KaizenController@CarritoEliminaItem');
Route::get('CarritoCambiaCanti','KaizenController@CarritoCambiaCanti');


Route::get('Detalle', function () {
    return view('Detalle_Producto');
});


Route::get('/', function () {
    return view('Lista_Producto');
});

Route::get('/cat', function () {
    return view('categorias');
});




Route::get('/inventario', function () { return view('menu'); });
Route::get('listadoProductos','KaizenController@listadoProductos');


Route::get('/productos', function () { return view('edit_producto'); });
Route::get('/tmp', function () { return view('administracion.listadoProducto'); });
