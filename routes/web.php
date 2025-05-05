<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VistasIntranetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas para la web Publicas
//Rutas get
Route::get('/login', [VistasIntranetController::class, 'vistalogin'])->name('vistalogin');
Route::get('/dashboard', [VistasIntranetController::class, 'vistadashboard'])->name('vistadashboard');
Route::get('/vehiculo', [VistasIntranetController::class, 'vistavehiculo'])->name('vistavehiculo');
Route::post('/mantenimientovehiculo', [VehiculoController::class, 'mantenimientovehiculo'])->name('api.mantenimientovehiculo');
Route::post('/estadovehiculo', [VehiculoController::class, 'eliminarvehiculo'])->name('api.eliminarvehiculo');

Route::get('/producto', [VistasIntranetController::class, 'vistaproducto'])->name('vistaproducto');
Route::post('/registrarproducto', [ProductoController::class, 'registrarProducto'])->name('api.registrarProducto');