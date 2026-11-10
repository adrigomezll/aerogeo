<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');


Route::view('/register', 'register')->name('register');
