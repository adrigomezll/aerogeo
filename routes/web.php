<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\NivelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login y registro
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registro', [RegistroController::class, 'create'])->name('registro.create');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');

// Juego 1 (AeroGeo): solo con la sesión iniciada
Route::middleware('auth')->group(function () {

    // Menú de niveles
    Route::get('/inicioP', [NivelController::class, 'menu'])
        ->name('inicioPiloto');

    // Mapa de comunidades autónomas
    Route::get('/inicioP/nivel/{nivel}', [NivelController::class, 'comunidades'])
        ->whereNumber('nivel')
        ->name('comunidades');

    // Mapa de aeropuertos
    Route::get('/inicioP/nivel/{nivel}/juegoP', [NivelController::class, 'aeropuertos'])
        ->whereNumber('nivel')
        ->name('juegoPiloto');

    // Guardar el nivel como completado
    Route::post('/inicioP/nivel/{nivel}/completar', [NivelController::class, 'completar'])
        ->whereNumber('nivel')
        ->name('completar');
});