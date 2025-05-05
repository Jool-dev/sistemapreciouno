<?php

use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VistasIntranetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas para la web Publicas
Route::get('/login', [VistasIntranetController::class, 'vistalogin'])->name('vistalogin');
Route::get('/dashboard', [VistasIntranetController::class, 'vistadashboard'])->name('vistadashboard');
Route::get('/vehiculo', [VistasIntranetController::class, 'vistavehiculo'])->name('vistavehiculo');
Route::get('/usuarios', [VistasIntranetController::class, 'vistausuarios'])->name('vistausuarios');
Route::post('/registrarvehiculo', [VehiculoController::class, 'registrarVehiculo'])->name('api.registrarVehiculo');
