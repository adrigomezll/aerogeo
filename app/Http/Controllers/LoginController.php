<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Muestra el formulario
    public function showLogin()
    {
        return view('login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        // 1. Capturar datos
        $datos = $request->validate([
            'correo'     => ['required', 'email'],
            'contrasena' => ['required'],
        ]);

        // 2. Buscar al usuario
        $usuario = Usuario::where('correo', $datos['correo'])->first();

        // 3 y 4. Comprobar que existe y que la contraseña coincide con el hash
        if (!$usuario || !Hash::check($datos['contrasena'], $usuario->contrasena)) {
            return back()
                ->withErrors(['correo' => 'Correo o contraseña incorrectos.'])
                ->withInput($request->only('correo'));
        }

        // 5. Registrar al usuario en la sesión
        Auth::login($usuario);

        return redirect()->route('landing');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}