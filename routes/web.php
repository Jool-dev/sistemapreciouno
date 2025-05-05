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
Route::get('/producto', [VistasIntranetController::class, 'vistaproducto'])->name('vistaproducto');
//Rutas post
Route::post('/registrarvehiculo', [VehiculoController::class, 'registrarVehiculo'])->name('api.registrarVehiculo');
Route::post('/registrarproducto', [ProductoController::class, 'registrarProducto'])->name('api.registrarProducto');
