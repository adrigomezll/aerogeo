<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Pantalla de inicio del juego</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#001a33] text-white min-h-screen flex flex-col">

    <x-header />

    {{-- Lista de niveles. $completados llega desde NivelController@menu --}}
    @php
        $niveles = [
            ['numero' => 1, 'destino' => 'Madrid', 'texto' => 'Tu primer vuelo. Aprende las comunidades del centro de España.'],
            ['numero' => 2, 'destino' => 'Zaragoza', 'texto' => 'Cruza el valle del Ebro y descubre sus ciudades.'],
            ['numero' => 3, 'destino' => 'Santiago de Compostela', 'texto' => 'El gran vuelo hacia el noroeste de España.'],
        ];

        // Un nivel está abierto si es el 1 o si el anterior está completado
        foreach ($niveles as $i => $nivel) {
            $niveles[$i]['abierto'] = $nivel['numero'] == 1 || in_array($nivel['numero'] - 1, $completados);
            $niveles[$i]['completado'] = in_array($nivel['numero'], $completados);
        }
    @endphp

    <main class="flex-1 bg-cover bg-center bg-fixed"
      style="background-image: linear-gradient(rgba(0, 26, 51, 0.75), rgba(0, 26, 51, 0.75)), url('{{ asset('images/dospilotos.png') }}');">
        <div class="max-w-5xl mx-auto px-6 py-16">

            {{-- Bloque principal --}}
            <section class="text-center">
                <span class="inline-block border border-white/30 rounded-full px-4 py-1 text-sm">
                    <span class="text-yellow-400">●</span> Modo piloto
                </span>

                <h1 class="text-4xl md:text-6xl font-extrabold mt-6 leading-tight">
                    Bienvenido a bordo, piloto.
                    <span class="block text-yellow-400">Tu destino te espera</span>
                </h1>

                <p class="mt-6 max-w-2xl mx-auto text-white/90">
                    Estás al mando de un avión con rumbo a una ciudad de España.
                    Para llegar, tendrás que arrastrar y colocar cada pieza en su sitio.
                    Cuanto mejor conozcas el mapa, más lejos llegarás.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#niveles"
                       class="bg-yellow-400 text-[#001a33] font-bold px-8 py-3 rounded-full hover:bg-yellow-300 transition">
                        Empezar el vuelo
                    </a>
                    <a href="#como-se-juega"
                       class="border border-yellow-400 text-yellow-400 font-bold px-8 py-3 rounded-full hover:bg-yellow-400 hover:text-[#001a33] transition">
                        Cómo se juega
                    </a>
                </div>
            </section>

            {{-- Selección de nivel --}}
            <section id="niveles" class="mt-20">
                <h2 class="text-2xl md:text-3xl font-bold text-center">Elige tu destino</h2>

                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach ($niveles as $nivel)
                        <div class="rounded-2xl p-6 border {{ $nivel['abierto'] ? 'border-yellow-400 bg-white/10' : 'border-white/20 bg-white/5 opacity-70' }}">
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-400 font-bold">Nivel {{ $nivel['numero'] }}</p>

                                @if ($nivel['completado'])
                                    <span class="text-green-400 text-sm font-bold">
                                        <i class="fa-solid fa-circle-check"></i> Completado
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-extrabold mt-2">{{ $nivel['destino'] }}</h3>
                            <p class="text-sm text-white/80 mt-3">{{ $nivel['texto'] }}</p>

                            @if ($nivel['abierto'])
                                <a href="{{ route('comunidades', $nivel['numero']) }}"
                                   class="block text-center mt-6 bg-yellow-400 text-[#001a33] font-bold py-2 rounded-full hover:bg-yellow-300 transition">
                                    {{ $nivel['completado'] ? 'Volver a jugar' : 'Despegar' }}
                                </a>
                            @else
                                <p class="text-center mt-6 text-white/60 font-semibold">
                                    <i class="fa-solid fa-lock"></i> Bloqueado
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Explicación de la mecánica --}}
            <section id="como-se-juega" class="mt-20 text-center">
                <h2 class="text-2xl md:text-3xl font-bold">Cómo se juega</h2>

                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    <div class="bg-white/5 border border-white/20 rounded-2xl p-6">
                        <i class="fa-solid fa-hand-pointer text-yellow-400 text-3xl"></i>
                        <h3 class="font-bold mt-4">Arrastra</h3>
                        <p class="text-sm text-white/80 mt-2">Coge la pieza con el ratón y muévela por la pantalla.</p>
                    </div>
                    <div class="bg-white/5 border border-white/20 rounded-2xl p-6">
                        <i class="fa-solid fa-location-dot text-yellow-400 text-3xl"></i>
                        <h3 class="font-bold mt-4">Suelta</h3>
                        <p class="text-sm text-white/80 mt-2">Déjala en el lugar que creas correcto.</p>
                    </div>
                    <div class="bg-white/5 border border-white/20 rounded-2xl p-6">
                        <i class="fa-solid fa-plane text-yellow-400 text-3xl"></i>
                        <h3 class="font-bold mt-4">Aterriza</h3>
                        <p class="text-sm text-white/80 mt-2">Si aciertas, tu avión avanza hasta llegar al destino.</p>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <x-footer />

</body>
</html>