<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
        public function create(): View
    {
        return view('registro');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre'             => ['required', 'string', 'max:100'],
            'correo'             => ['required', 'email', 'max:255', 'unique:usuario,correo'],
            'contrasena'         => ['required', 'string', 'min:8'],
            'repetir_contrasena' => ['required', 'same:contrasena'],
            'terms'              => ['accepted'],
        ]);

        $usuario = Usuario::create([
            'nombre'     => $datos['nombre'],
            'correo'     => $datos['correo'],
            'contrasena' => Hash::make($datos['contrasena']),
        ]);

        // Inicia sesión directamente tras registrarse
        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect('/'); // cambia por la ruta a la que quieras enviar al usuario
    }

    /**
     * Store a newly created resource in storage.

     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
