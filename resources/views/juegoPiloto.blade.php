<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AeroGeo - Nivel {{ $numeroNivel }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#001a33] text-white min-h-screen flex flex-col">

    <x-header />

    {{-- Datos de cada nivel. Cada pista tiene su aeropuerto y su posición en el mapa (en %) --}}
    @php
        // $numeroNivel llega desde NivelController@aeropuertos

        $niveles = [
            1 => [
                'mapa' => 'mapaMadrid.png',
                'ancho' => 1408,
                'alto' => 768,
                'destino' => 'Madrid-Barajas',
                'historia' => 'El motor derecho ha fallado y se ha ido toda la electricidad.
                               No tienes ruta. Saca el mapa, busca la pista de tu destino y aterriza
                               antes de que se acabe el tiempo.',
                'pistas' => [
                    ['aeropuerto' => 'Madrid-Barajas', 'arriba' => '39.5%', 'izquierda' => '56.5%'],
                    ['aeropuerto' => 'Torrejón', 'arriba' => '47.3%', 'izquierda' => '65.3%'],
                    ['aeropuerto' => 'Cuatro Vientos', 'arriba' => '74%', 'izquierda' => '39.4%'],
                ],
            ],
            2 => [
                'mapa' => 'mapaAragon.png',
                // Pon aquí el tamaño real de tu imagen en píxeles
                'ancho' => 1408,
                'alto' => 768,
                'destino' => 'Zaragoza',
                'historia' => 'Has atravesado una tormenta sobre el valle del Ebro y el GPS ha dejado
                               de funcionar. Te queda poco combustible. Busca la pista de Zaragoza
                               en el mapa y aterriza antes de que se acabe el tiempo.',
                // Posiciones aproximadas: ajústalas a tu imagen
                'pistas' => [
                    ['aeropuerto' => 'Huesca-Pirineos', 'arriba' => '35%', 'izquierda' => '55.4%'],
                    ['aeropuerto' => 'Zaragoza', 'arriba' => '48%', 'izquierda' => '52%'],
                    ['aeropuerto' => 'Teruel', 'arriba' => '78%', 'izquierda' => '45%'],
                ],
            ],
            3 => [
                'mapa' => 'mapaGalicia.png',
                // Pon aquí el tamaño real de tu imagen en píxeles
                'ancho' => 1408,
                'alto' => 768,
                'destino' => 'Santiago-Rosalía de Castro',
                'historia' => 'Una niebla cerrada cubre la costa gallega y la torre de control no responde.
                               Vuelas a ciegas con los instrumentos justos. Encuentra la pista de Santiago
                               en el mapa y aterriza antes de que se acabe el tiempo.',
                // Posiciones aproximadas: ajústalas a tu imagen
                'pistas' => [
                    ['aeropuerto' => 'A Coruña', 'arriba' => '30.1%', 'izquierda' => '52.3%'],
                    ['aeropuerto' => 'Santiago-Rosalía de Castro', 'arriba' => '47.3%', 'izquierda' => '48.9%'],
                    ['aeropuerto' => 'Vigo', 'arriba' => '78.2%', 'izquierda' => '46.6%'],
                ],
            ],
        ];

        // Cogemos solo los datos del nivel actual
        $nivel = $niveles[$numeroNivel];

        // Al aterrizar, se pasa al mapa de comunidades del siguiente nivel.
        // En el último nivel no hay siguiente.
        $siguiente = isset($niveles[$numeroNivel + 1]) ? route('comunidades', $numeroNivel + 1) : '';
    @endphp

    <main class="flex-1 bg-gradient-to-b from-[#001a33] to-[#06365e]">
        <div class="max-w-4xl mx-auto px-6 py-8">

            {{-- Barra superior: nivel y tiempo --}}
            <div class="flex items-center justify-between">
                <p class="text-yellow-400 font-bold">Nivel {{ $numeroNivel }}</p>

                <div class="border border-yellow-400 rounded-full px-5 py-2 font-bold">
                    <i class="fa-solid fa-clock text-yellow-400"></i>
                    <span id="tiempo">20</span> s
                </div>
            </div>

            {{-- Storytelling --}}
            <div class="mt-6 bg-white/10 border border-white/20 rounded-2xl p-5">
                <p class="text-yellow-400 font-bold">
                    <i class="fa-solid fa-triangle-exclamation"></i> Emergencia a bordo
                </p>
                <p class="mt-2 text-white/90">
                    {{ $nivel['historia'] }}
                </p>
            </div>

            {{-- Nombre del destino (este es el elemento que se arrastra) --}}
            <div class="mt-3">
                <div id="destino" draggable="true" data-aeropuerto="{{ $nivel['destino'] }}"
                    class="inline-block bg-yellow-400 text-[#001a33] font-extrabold text-xs px-3 py-1 rounded-full cursor-grab">
                    {{ $nivel['destino'] }}
                </div>
            </div>

            {{-- Mapa --}}
            <div id="mapa" data-siguiente="{{ $siguiente }}" data-nivel-siguiente="{{ $numeroNivel + 1 }}"
                class="relative mt-8 w-full rounded-2xl border border-white/20 bg-cover bg-center"
                style="aspect-ratio: {{ $nivel['ancho'] }} / {{ $nivel['alto'] }};
                       background-image: url('{{ asset('images/' . $nivel['mapa']) }}');"
                       data-completar="{{ route('completar', $numeroNivel) }}">

                @foreach ($nivel['pistas'] as $pista)
                    <div class="zona-destino absolute -translate-x-1/2 -translate-y-1/2 min-w-[5rem] h-8 px-1 border-2 border-dashed border-white bg-[#001a33]/60 rounded-lg flex items-center justify-center text-xs font-bold"
                        style="top: {{ $pista['arriba'] }}; left: {{ $pista['izquierda'] }};"
                        data-aeropuerto="{{ $pista['aeropuerto'] }}">
                    </div>
                @endforeach
            </div>

            {{-- Mensaje de resultado (el JS lo rellenará) --}}
            <p id="mensaje" class="mt-6 text-center text-xl font-bold"></p>

            {{-- Botón para validar la respuesta --}}
            <div class="mt-6 text-center">
                <button id="validar" type="button"
                    class="bg-yellow-400 text-[#001a33] font-bold px-8 py-3 rounded-full hover:bg-yellow-300 transition">
                    Validar
                </button>
                @if ($siguiente)
                    <div class="mt-4 text-center">
                        <a id="siguienteNivel" href="{{ $siguiente }}"
                            class="hidden inline-block bg-white text-[#001a33] font-bold px-8 py-3 rounded-full hover:bg-gray-200 transition">
                            Siguiente nivel <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <x-footer />

    @vite('resources/js/juego.js')

</body>

</html>
