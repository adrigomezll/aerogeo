<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludos/{nombre?}', function ($nombre = "invitado"){
    return "Bienvenido a laravel " . $nombre;
})->name("saludo");

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');

