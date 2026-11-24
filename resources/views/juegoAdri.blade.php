@extends('app')

@section('content')
    <section id="juegoAdri" class="bg-slate-100 px-5 py-10">

        <div class="mx-auto max-w-7xl">

            <!-- Título del juego -->
            <div class="mb-8 text-center">

                <span class="text-sm font-bold uppercase tracking-widest text-[#0072CE]">
                    Misión 02 · Barcelona
                </span>

                <h1 class="mt-2 text-4xl font-extrabold text-[#002B49]">
                    Búsqueda del motor perdido
                </h1>

                <p class="mt-3 text-lg text-slate-600">
                    Explora Barcelona, descubre las pistas
                    y recupera el motor del avión.
                </p>

            </div>

            <!-- Contenedor del juego -->
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-xl">

                <!-- Encabezado del mapa -->
                <div class="mb-4 flex items-center justify-between">

                    <span class="rounded-full bg-[#FFD100] px-5 py-2 font-bold text-[#002B49]">
                        Nivel 1
                    </span>

                </div>

                <!-- Mapa -->
                <div id="mapaBarcelona" class="relative w-full overflow-hidden rounded-2xl">

                    <!-- Fondo -->
                    <img src="{{ asset('images/J2MapaFondo.jpg') }}" alt="Mapa de Barcelona" class="block h-auto w-full"
                        draggable="false">

                    <!-- Park Güell -->
                    <img src="{{ asset('images/J2parcguell.png') }}" id="parcguell" class="monumento absolute"
                        style="top: 28%; left: 57%; width: 20%;" draggable="false">

                    <!-- Sagrada Familia -->
                    <img src="{{ asset('images/J2sagradafamilia.png') }}" id="sagradafamilia" class="monumento absolute"
                        style="top: 32%; left: 36%; width: 22%;" draggable="false">

                    <!-- Plaza de España -->
                    <img src="{{ asset('images/J2plzespaña.png') }}" id="plazaespana" class="monumento absolute"
                        style="top: 55%; left: 8%; width: 22%;" draggable="false">

                    <!-- Las Ramblas -->
                    <img src="{{ asset('images/J2ramblas.png') }}" id="ramblas" class="monumento absolute"
                        style="top: 55%; left: 44%; width: 18%;" draggable="false">

                    <!-- Torres Mapfre -->
                    <img src="{{ asset('images/J2torresmapfre.png') }}" id="torresmapfre" class="monumento absolute"
                        style="top: 45%; left: 80%; width: 15%;" draggable="false">

                    <!-- Investigador -->
                    <img src="{{ asset('images/J2personaje.png') }}" id="investigador" class="absolute"
                        style="top: 59%; left: 73%; width: 8%;" alt="Investigador" draggable="false">

                </div>

                <!-- Instrucciones -->
                <div class="mt-4 rounded-xl bg-sky-50 p-4 text-[#002B49]">

                    <p>
                        <strong>Instrucciones:</strong>
                        Arrastra al investigador hacia los monumentos
                        para descubrir nuevas pistas.
                    </p>

                </div>

            </div>

        </div>

    </section>
@endsection

<style>
    .monumento {
        filter:
            drop-shadow(1px 0 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(0 -1px 0 white);

        transition: transform 0.2s ease;
    }

    .monumento:hover {
        transform: scale(1.08);
        z-index: 5;
    }

    /* Investigador */
    #investigador {
        z-index: 10;
        cursor: grab;
        user-select: none;

        filter:
            drop-shadow(1px 0 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(0 -1px 0 white);
    }

    #investigador:active {
        cursor: grabbing;
    }
</style>
