<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwofactorCodeController;
use App\Http\Controllers\KpiController;


Route::get('/', function () {
    return view('index');
});

//rutas de doble factor de autentificacion
Route::get('verify', [TwofactorCodeController::class, 'verify'])->name('verify');
Route::get('verify/resend', [TwofactorCodeController::class, 'resend'])->name('verify.resend');
Route::post('verify', [TwoFactorCodeController::class, 'verifyPost'])->name('verify.post');


// Ruta del dashboard del administrador
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'two_factor']);

// Ruta para admin/usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para gestión de usuarios panel crear
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para gestión de envio de formulario crear
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver usuario por id
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver editar usuario
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para enviar la actualizacion de usuario
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver eliminar usuario
Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para mandar la eliminacion
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware(['auth', 'verified', 'two_factor']);


//rutas de ventas
Route::get('/admin/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('admin.ventas.index')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para gestión de ventas panel crear
Route::get('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'create'])->name('admin.ventas.create')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para gestión de envio de formulario crear
Route::post('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'store'])->name('admin.ventas.store')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver Venta por id
Route::get('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('admin.ventas.show')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver editar Venta
Route::get('/admin/ventas/{id}/edit', [App\Http\Controllers\VentaController::class, 'edit'])->name('admin.ventas.edit')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para enviar la actualizacion Venta
Route::put('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'update'])->name('admin.ventas.update')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para ver eliminar Venta
Route::get('/admin/ventas/{id}/confirm-delete', [App\Http\Controllers\VentaController::class, 'confirmDelete'])->name('admin.ventas.confirmDelete')->middleware(['auth', 'verified', 'two_factor']);
// Ruta para mandar la eliminacion
Route::delete('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('admin.ventas.destroy')->middleware(['auth', 'verified', 'two_factor']);


//Rutas para ver usuario activo
//Route::get('/admin/sesiones', [App\Http\Controllers\SessionController::class, 'index'])->name('admin.sesiones.index')->middleware(['auth', 'verified', 'two_factor']);


//rutas AJAX -- valida para obtener los usuarios activos
Route::get('/admin/sesiones', [App\Http\Controllers\SessionController::class, 'index'])->name('admin.sesiones.index')->middleware(['auth', 'verified', 'two_factor']);
Route::get('/admin/sesiones/activos', [App\Http\Controllers\SessionController::class, 'obtenerUsuariosActivos'])->name('admin.sesiones.obtener')->middleware(['auth', 'verified', 'two_factor']);




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'two_factor'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
