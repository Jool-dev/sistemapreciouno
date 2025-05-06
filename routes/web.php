<?php

use App\Http\Controllers\GuiasRemisionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VistasIntranetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas para la web Publicas
//Rutas get
Route::get('/login', [VistasIntranetController::class, 'vistalogin'])->name('vistalogin');
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/dashboard', [VistasIntranetController::class, 'vistadashboard'])->name('vistadashboard');

    //usuarios
    Route::get('/usuarios', [VistasIntranetController::class, 'vistausuarios'])->name('vistausuarios');

    //vehiculo
    Route::get('/vehiculo', [VistasIntranetController::class, 'vistavehiculo'])->name('vistavehiculo');
    Route::post('/mantenimientovehiculo', [VehiculoController::class, 'mantenimientovehiculo'])->name('api.mantenimientovehiculo');
    Route::post('/estadovehiculo', [VehiculoController::class, 'eliminarvehiculo'])->name('api.eliminarvehiculo');
    //productos
    Route::get('/producto', [VistasIntranetController::class, 'vistaproducto'])->name('vistaproducto');
    Route::post('/registrarproducto', [ProductoController::class, 'registrarProducto'])->name('api.registrarProducto');
    Route::post('/eliminarproducto', [ProductoController::class, 'eliminarProducto'])->name('api.eliminarProducto');
});


//Vista para prevencionista
Route::middleware(['auth', 'role:prevencionista'])->group(function () {
    Route::get('/prevencionista', [VistasIntranetController::class, 'vistaprevencionista'])->name('vistaprevencionista');
    Route::get('/guiasremision', [VistasIntranetController::class, 'vistaguiasderemision'])->name('vistaguiasderemision');
    Route::get('/revisionguias', [VistasIntranetController::class, 'vistarevisionguias'])->name('vistarevisionguias');

    Route::get('/guiasremision/{id}/detalle', [VistasIntranetController::class, 'vistadetalleguia'])->name('guias.detalle');
    Route::post('/registrarguiaremision', [GuiasRemisionController::class, 'registrarGuiaRemision'])->name('registrarGuiaRemision');
});

Route::post('/iniciarsesion', [UsuariosController::class, 'validarLogin'])->name('api.validarLogin');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return response()->json(['success' => true]);
})->name('logout');
