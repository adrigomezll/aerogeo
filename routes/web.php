<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NivelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');

Route::view('/register', 'register')->name('register');

Route::view('/inicioP', 'inicioPiloto')->name('inicioPiloto');

Route::get('/inicioP/nivel/{nivel}', [NivelController::class, 'comunidades'])
    ->whereNumber('nivel')
    ->name('comunidades');

Route::get('/inicioP/nivel/{nivel}/juegoP', [NivelController::class, 'aeropuertos'])
    ->whereNumber('nivel')
    ->name('juegoPiloto');