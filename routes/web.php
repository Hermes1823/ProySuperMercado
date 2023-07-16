<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rol2Controller;
use App\Http\Controllers\Usuario1Controller;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MontacargaController;
use App\Http\Controllers\AlmaceneroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequisitionOrdersController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

//USUARIO
Route::resource('usuarioo',Usuario1Controller::class);
//RES
Route::resource('ConfigUsuarioR',RegisteredUserController::class);
Route::post('RegisForUser', [RegisteredUserController::class, 'RegisFor'])->name('RegisForUser');


//Listar empleados y editar
Route::get('indexU', [RegisteredUserController::class, 'index'])->name('indexU');
Route::get('editU{id}/', [RegisteredUserController::class, 'edit'])->name('editU')->middleware('auth');

//Actualizando Empleado
Route::post('ActualizarEmpleado{id}/',[RegisteredUserController::class,'update'])->name('ActualizarPassword');
Route::get('confirU{id}/',[RegisteredUserController::class,'confirmar'])->name('confirU')->middleware('auth');
Route::post('EmpleadoEliminar{id}/', [RegisteredUserController::class, 'destroy'])->name('EliminarEmpleado');
Route::get('Empleadocancelar/',[RegisteredUserController::class,'cancelar'])->name('EmpleadoCancelar')->middleware('auth');

//Roles
Route::resource('Roles',Rol2Controller::class);
Route::get('Rolcancelar',[Rol2Controller::class,'cancelar'])->name('Rol.cancelar');
Route::get('confirmarRol{id}/',[Rol2Controller::class,'confirmar'])->name('Rol.confirmar');

//Productos
Route::get('productos',[ProductController::class,'index'])->name('product.index');
Route::post('productos', [ProductController::class, 'store'])->name('product.store');
Route::post('productos/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::post('productos/update',[ProductController::class,'update'])->name('product.update');

//Órdenes de Requisicón
Route::get('requisitionOrders',[RequisitionOrdersController::class,'index'])->name('requisitionOrders.index');
Route::get('requisitionOrders/create',[RequisitionOrdersController::class,'create'])->name('requisitionOrders.create');
Route::post('requisitionOrders/create',[RequisitionOrdersController::class,'register'])->name('requisitionOrders.register');
Route::post('requisitionOrders/show',[RequisitionOrdersController::class,'show'])->name('requisitionOrders.show');
Route::post('requisitionOrders/solicitudCotizacion',[RequisitionOrdersController::class,'generarSolicitudCotizacion'])->name('requisitionOrders.solicitudCotizacion');
Route::get('requisitionOrders/visualizarCotizacionPDF/{id}', [RequisitionOrdersController::class, 'solicitudCotizacionPDF'])->name('solicitudCotizacionPDF');


//Almacen
Route::resource('Almacen',AlmacenController::class);
Route::get('Almacencancelar',[AlmacenController::class,'cancelar'])->name('Almacen.cancelar');
Route::get('confirmarA{id}/',[AlmacenController::class,'confirmar'])->name('Almacen.confirmar');
//Montacarga
Route::resource('Montacarga',MontacargaController::class);
Route::get('Montacargacancelar',[MontacargaController::class,'cancelar'])->name('Montacarga.cancelar');
Route::get('confirmarM{id}/',[MontacargaController::class,'confirmar'])->name('Montacarga.confirmar');

//Detalle_Almacen
Route::resource('Almacenero',AlmaceneroController::class);
Route::get('Almacenerocancelar',[AlmaceneroController::class,'cancelar'])->name('Almacenero.cancelar');
Route::get('confirmarAlma{id}/',[AlmaceneroController::class,'confirmar'])->name('Almacenero.confirmar');

//Cliente
Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/clientes/{id}/confirmar', [ClienteController::class, 'confirmar'])->name('cliente.confirmar');

//cupones

Route::get('/cupones/index', [CuponController::class, 'index'])->name('cupon.index');
Route::get('/cupones/create', [CuponController::class, 'create'])->name('cupon.create');
Route::post('/cupones', [CuponController::class, 'store'])->name('cupon.store');
Route::get('/cupones/{id}/edit', [CuponController::class, 'edit'])->name('cupon.edit');
Route::put('/cupones/{id}', [CuponController::class, 'update'])->name('cupon.update');

Route::delete('/cupones/{id}', [CuponController::class, 'destroy'])->name('cupon.destroy');


Route::get('/cupones/{id}/confirmar', [CuponController::class, 'confirmar'])->name('cupon.confirmar');
