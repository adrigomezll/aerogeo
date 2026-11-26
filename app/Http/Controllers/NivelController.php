<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NivelController extends Controller
{
    // Menú de niveles: busca qué niveles del juego 1 ha completado el usuario
    public function menu()
    {
        $completados = [];

        if (Auth::check()) {
            $completados = DB::table('progreso_niveles')
                ->join('niveles', 'progreso_niveles.nivel_id', '=', 'niveles.id')
                ->join('juegos', 'niveles.juego_id', '=', 'juegos.id')
                ->where('juegos.numero_juego', 1)
                ->where('progreso_niveles.usuario_id', Auth::id())
                ->where('progreso_niveles.completado', 1)
                ->pluck('niveles.numero_nivel')
                ->all();
        }

        return view('inicioPiloto', ['completados' => $completados]);
    }

    public function comunidades($nivel)
    {
        if ($nivel < 1 || $nivel > 3) {
            abort(404);
        }

        return view('comunidadesAutonomas', ['numeroNivel' => $nivel]);
    }

    public function aeropuertos($nivel)
    {
        if ($nivel < 1 || $nivel > 3) {
            abort(404);
        }

        return view('juegoPiloto', ['numeroNivel' => $nivel]);
    }

    public function completar($nivel)
    {
        // Si no hay sesión iniciada, no se guarda nada
        if (! Auth::check()) {
            return response()->json(['guardado' => false], 401);
        }

        // En la tabla niveles el nivel se identifica por su id, no por su número
        $nivelId = DB::table('niveles')
            ->join('juegos', 'niveles.juego_id', '=', 'juegos.id')
            ->where('juegos.numero_juego', 1)
            ->where('niveles.numero_nivel', $nivel)
            ->value('niveles.id');

        if (! $nivelId) {
            return response()->json(['guardado' => false], 404);
        }

        // Actualiza la fila si ya existe, o la crea si es la primera vez
        DB::table('progreso_niveles')->updateOrInsert(
            ['usuario_id' => Auth::id(), 'nivel_id' => $nivelId],
            ['completado' => 1, 'updated_at' => now()]
        );

        return response()->json(['guardado' => true]);
    }
}