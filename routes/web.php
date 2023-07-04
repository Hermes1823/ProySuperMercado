<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rol2Controller;
use App\Http\Controllers\Usuario1Controller;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MontacargaController;
use App\Http\Controllers\AlmaceneroController;
use App\Http\Controllers\ProductController;

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
