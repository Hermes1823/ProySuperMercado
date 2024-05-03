<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rol2Controller;
use App\Http\Controllers\Usuario1Controller;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MontacargaController;
use App\Http\Controllers\AlmaceneroController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequisitionOrdersController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\DetalleEncuestaController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConvocatoriaController;

use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ReporteSubComprasController;
use App\Http\Controllers\SolicitudCotizacionController;
use App\Models\Pregunta;

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

//Solicitudes de cotización
Route::get('solicitudesCotizacion',[SolicitudCotizacionController::class,'index'])->name('solicitud-cotizacion.index');
Route::get('solicitudesCotizacion/pdf/{id}',[SolicitudCotizacionController::class,'pdf'])->name('solicitud-cotizacion.pdf');


//reportes subcompras
Route::get('reportesSubCompras',[ReporteSubComprasController::class,'reportes'])->name('reporte-subcompras');


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


//Informe
Route::resource('Informe',InformeController::class);
Route::get('Informcancelar',[InformeController::class,'cancelar'])->name('Informe.cancelar');
Route::get('confirmarInform{id}/',[InformeController::class,'confirmar'])->name('Informe.confirmar');

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

//pregunta

Route::get('preguntas',[PreguntaController::class, 'index'])->name('pregunta.index');
Route::get('/preguntas/create', [PreguntaController::class, 'create'])->name('pregunta.create');
Route::post('/preguntas', [PreguntaController::class, 'store'])->name('pregunta.store');
Route::get('/preguntas/{id}/edit', [PreguntaController::class, 'edit'])->name('pregunta.edit');
Route::put('/preguntas/{id}', [PreguntaController::class, 'update'])->name('pregunta.update');
Route::delete('/preguntas/{id}', [PreguntaController::class, 'destroy'])->name('pregunta.destroy');
Route::get('/pregunta/{id}/confirmar', [PreguntaController::class, 'confirmar'])->name('pregunta.confirmar');

//encuesta

//Route::get('/encuestas', [EncuestaController::class, 'index'])->name('encuesta.index');
//Route::get('/encuestas/create', [EncuestaController::class, 'create'])->name('encuesta.create');
//Route::post('/encuestas', [EncuestaController::class, 'store'])->name('encuesta.store');

// Postulantes
Route::resource('postulante',PostulanteController::class);
Route::get('postulante/cancelar',[PostulanteController::class,'cancelar'])->name('postulante.cancelar');
Route::get('postulante/confirmar/{id}',[PostulanteController::class,'confirmar'])->name('postulante.confirmar');

// Convocatorias
Route::resource('convocatoria',ConvocatoriaController::class);
Route::get('convocatoria/cancelar',[ConvocatoriaController::class,'cancelar'])->name('convocatoria.cancelar');
Route::get('convocatoria/confirmar/{id}',[ConvocatoriaController::class,'confirmar'])->name('convocatoria.confirmar');
Route::get('convocatoria/asignar/{id}',[ConvocatoriaController::class,'asignar'])->name('convocatoria.asignar');
Route::post('convocatoria/asignar/store',[ConvocatoriaController::class,'asignar_store'])->name('convocatoria.asignar_store');
Route::get('convocatoria/asignar/delete',[ConvocatoriaController::class,'asignar_delete'])->name('convocatoria.asignar_delete');
Route::get('convocatoria/calificar/{id}',[ConvocatoriaController::class,'calificar'])->name('convocatoria.calificar');
Route::post('convocatoria/calificar/store',[ConvocatoriaController::class,'calificar_store'])->name('convocatoria.calificar_store');
Route::get('convocatoria/calificar/delete',[ConvocatoriaController::class,'calificar_delete'])->name('convocatoria.calificar_delete');

//promociones

Route::get('/promociones', [PromocionController::class, 'index'])->name('promocion.index');
Route::get('/promociones/create', [PromocionController::class, 'create'])->name('promocion.create');
Route::post('/promociones', [PromocionController::class, 'store'])->name('promocion.store');
Route::get('/promociones/{promocion}/edit', [PromocionController::class, 'edit'])->name('promocion.edit');
Route::put('/promociones/{promocion}', [PromocionController::class, 'update'])->name('promocion.update');
Route::get('/promociones/{promocion}/confirmar', [PromocionController::class, 'confirmar'])->name('promocion.confirmar');
Route::delete('/promociones/{promocion}', [PromocionController::class, 'destroy'])->name('promocion.destroy');

Route::get('/promociones/pdf', [PromocionController::class, 'pdf'])->name('promocion.pdf');

//detalle encuesta

Route::get('/detalleencuesta', [DetalleEncuestaController::class, 'index'])->name('detalleencuesta.index');
Route::get('/detalleencuesta/create', [DetalleEncuestaController::class, 'create'])->name('detalleencuesta.create');

// Ruta para guardar el detalle de encuesta
Route::post('/detalleencuesta', [DetalleEncuestaController::class, 'store'])->name('detalleencuesta.store');


Route::get('/ir-al-segundo-proyecto', function () {
    return redirect('http://localhost:8081');
})->name('segundo');