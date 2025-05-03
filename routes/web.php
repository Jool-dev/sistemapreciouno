<?php

use App\Http\Controllers\VistasIntranetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas para la web Publicas
Route::get('/login', [VistasIntranetController::class, 'vistalogin'])->name('vistalogin');
Route::get('/dashboard', [VistasIntranetController::class, 'vistadashboard'])->name('vistadashboard');
