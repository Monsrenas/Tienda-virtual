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

Route::get('firebase','KaizenController@index');
Route::get('Leerbase','KaizenController@Leerbase');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/inventario', function () {
    return view('menu');
});

Route::get('Detalle', function () {
    return view('Detalle_Producto');
});



Route::get('Lista', function () {
    return view('Lista_Producto');
});
