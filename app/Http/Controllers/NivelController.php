<?php

namespace App\Http\Controllers;

class NivelController extends Controller
{
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
}