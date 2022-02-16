<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoEquipoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/sumajst', function () {
    return view('sumajst.plantilla');
})->name('sumajst');
Route::resource('marcas', MarcaController::class)->names('admin.marcas');
Route::resource('tipos', TipoEquipoController::class)->names('admin.tipos');
Route::resource('proveedors', ProveedorController::class)->names('admin.proveedors');
Route::resource('articulos', ArticuloController::class)->names('admin.articulos');


Route::get('cambio_de_estado/articulos/{articulo}', [ArticuloController::class, 'cambio_de_estado'])->name('cambio.estado.articulos');
// Route::get('cambio_de_estado/compras/{compra}', [CompraController::class, 'cambio_de_estado'])->name('cambio.estado.compras');
// Route::get('cambio_de_estado/ventas/{venta}', [VentaController::class, 'cambio_de_estado'])->name('cambio.estado.ventas');

