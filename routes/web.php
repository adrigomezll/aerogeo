<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\NivelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
}) -> name('landing');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registro', [RegistroController::class, 'create'])->name('registro.create');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');

Route::view('/inicioP', 'inicioPiloto')->name('inicioPiloto');

Route::get('/inicioP/nivel/{nivel}', [NivelController::class, 'comunidades'])
    ->whereNumber('nivel')
    ->name('comunidades');

Route::get('/inicioP/nivel/{nivel}/juegoP', [NivelController::class, 'aeropuertos'])
    ->whereNumber('nivel')
    ->name('juegoPiloto');