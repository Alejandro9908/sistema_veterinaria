<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('producto/categoria','CategoriaController');
Route::resource('producto/producto','ProductoController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');

Route::resource('acceso/usuario', 'UsuarioController');

Route::resource('compras/compra', 'CompraController');
Route::resource('ventas/mascota', 'MascotaController');

