<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SumajController;
use App\Http\Controllers\TipoEquipoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use App\Http\Livewire\ReportesController;
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
    return view('auth.login');
});


Route::get('/sumajst', [SumajController::class, 'index'])->middleware('auth:sanctum')->name('sumajst');
Route::get('/sumajst-dashboard', [HomeController::class, 'index'])->middleware('auth:sanctum')->name('sumajst-dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/sumajst', function () {
//     return view('sumajst.plantilla');
// })->name('sumajst');


Route::resource('users', UserController::class)->names('admin.users');
Route::resource('roles', RoleController::class)->names('admin.roles');


Route::get('reports', ReportesController::class)->middleware('auth:sanctum')->name('reports.reportes');

Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');
Route::get('report/pdf/{user}/{type}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');


Route::resource('marcas', MarcaController::class)->names('admin.marcas');
Route::resource('tipos', TipoEquipoController::class)->names('admin.tipos');
Route::resource('proveedors', ProveedorController::class)->names('admin.proveedors');
Route::resource('articulos', ArticuloController::class)->names('admin.articulos');
Route::resource('clientes', ClienteController::class)->names('admin.clientes');


Route::resource('compras', CompraController::class)->names('admin.compras')->except([
    'edit', 'update', 'destroy'
]);
Route::resource('ventas', VentaController::class)->names('admin.ventas')->except([
    'edit', 'update', 'destroy'
]);


Route::get('cambio_de_estado/articulos/{articulo}', [ArticuloController::class, 'cambio_de_estado'])->name('cambio.estado.articulos');
Route::get('cambio_de_estado/compras/{compra}', [CompraController::class, 'cambio_de_estado'])->name('cambio.estado.compras');
Route::get('cambio_de_estado/ventas/{venta}', [VentaController::class, 'cambio_de_estado'])->name('cambio.estado.ventas');

Route::get('get_products_by_barcode', [ArticuloController::class, 'get_products_by_barcode'])->name('get_products_by_barcode');
Route::get('get_products_by_id', [ArticuloController::class, 'get_products_by_id'])->name('get_products_by_id');
Route::get('print_barcode', [ArticuloController::class, 'print_barcode'])->name('print_barcode');


Route::get('compras/pdf/{compra}', [CompraController::class, 'pdf'])->name('compras.pdf');
Route::get('ventas/pdf/{venta}', [VentaController::class, 'pdf'])->name('ventas.pdf');