<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Elige la comunidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#001a33] text-white min-h-screen flex flex-col">

    <x-header />

    @php
        // $numeroNivel llega desde NivelController@comunidades

        $niveles = [
            1 => ['destino' => 'Madrid', 'comunidad' => 'madrid'],
            2 => ['destino' => 'Zaragoza', 'comunidad' => 'aragon'],
            3 => ['destino' => 'Santiago de Compostela', 'comunidad' => 'galicia'],
        ];

        $nivel = $niveles[$numeroNivel];

        // Tamaño real de la imagen del mapa, en píxeles
        $ancho = 1387;
        $alto = 752;

        // Clases comunes de todos los polígonos
        $clasesPoligono = 'fill-transparent hover:fill-yellow-400/60 stroke-transparent hover:stroke-white stroke-2 cursor-pointer';
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

            <h1 class="mt-2 text-2xl md:text-3xl font-extrabold">
                Tu destino es {{ $nivel['destino'] }}
            </h1>
            <p class="mt-2 text-white/90">
                Saca el mapa y marca en qué comunidad autónoma está.
            </p>

            {{-- Mapa: la imagen de fondo y el SVG encima --}}
            <div id="mapa" data-correcta="{{ $nivel['comunidad'] }}"
                data-siguiente="{{ route('juegoPiloto', $numeroNivel) }}"
                class="relative mt-8 w-full rounded-2xl border border-white/20 bg-cover bg-center"
                style="aspect-ratio: {{ $ancho }} / {{ $alto }};
                       background-image: url('{{ asset('images/comunidadesAutonomas.png') }}');">

                <svg viewBox="0 0 {{ $ancho }} {{ $alto }}" class="absolute inset-0 w-full h-full">

                    <polygon data-comunidad="madrid" class="{{ $clasesPoligono }}"
                        points="665,333,682,314,696,299,703,312,702,321,703,331,709,339,717,349,715,361,720,370,702,376,685,385,693,369,666,361,643,365" />

                    <polygon data-comunidad="aragon" class="{{ $clasesPoligono }}"
                        points="834,176,803,224,807,240,798,247,780,243,786,262,775,271,776,283,766,284,772,298,795,319,794,335,783,351,804,368,816,366,816,377,834,381,849,362,861,348,858,328,867,322,885,322,890,307,893,280,890,262,904,243,910,206,910,230,908,191,874,192" />

                    <polygon data-comunidad="galicia" class="{{ $clasesPoligono }}"
                        points="519,137,513,147,528,162,522,170,529,180,519,195,517,205,529,211,532,220,525,228,517,238,508,248,494,247,468,253,461,242,461,228,427,251,427,234,418,198,409,174,413,156,430,146,453,144,458,130,474,121,497,122" />

                    <polygon data-comunidad="cataluna" class="{{ $clasesPoligono }}"
                        points="1040,210,1030,222,1042,242,983,284,927,304,913,318,923,325,899,337,888,323,896,286,894,257,907,238,909,179,935,187,946,205,970,210,1016,203" />

                    <polygon data-comunidad="andalucia" class="{{ $clasesPoligono }}"
                        points="594,639,561,618,549,588,525,559,502,559,494,528,516,507,537,503,561,508,576,497,590,499,594,481,617,462,658,483,742,475,755,499,763,510,773,520,783,540,794,549,773,586,783,575,744,592,703,592,656,592,640,606,619,612" />

                    <polygon data-comunidad="extremadura" class="{{ $clasesPoligono }}"
                        points="520,497,502,477,522,436,492,399,520,392,527,372,516,358,561,345,584,357,603,364,603,380,613,394,619,411,635,417,623,460,594,475,586,489,561,510" />

                    <polygon data-comunidad="castilla-la-mancha" class="{{ $clasesPoligono }}"
                        points="607,372,637,362,687,370,670,360,683,384,718,374,714,355,705,329,699,298,732,290,769,304,751,306,792,320,787,345,804,366,814,378,802,405,814,394,814,423,800,417,816,436,827,450,829,466,816,462,800,470,802,481,785,481,771,487,759,497,746,477,720,479,683,479,658,481,621,458,629,438,637,425,621,411,609,392" />

                    <polygon data-comunidad="murcia" class="{{ $clasesPoligono }}"
                        points="763,499,794,481,820,464,824,485,829,507,841,530,818,536,792,547,775,530,779,516,763,508" />

                    <polygon data-comunidad="castilla-y-leon" class="{{ $clasesPoligono }}"
                        points="533,181,625,164,656,175,670,191,679,177,693,166,711,164,711,179,724,197,718,205,716,226,730,240,742,238,765,238,783,247,765,300,742,298,711,290,699,298,638,364,617,368,598,362,586,353,564,351,529,355,533,300,549,290,559,275,543,261,543,245,520,242,531,220,518,203,561,169" />

                    <polygon data-comunidad="asturias" class="{{ $clasesPoligono }}"
                        points="522,131,512,146,527,156,524,168,529,177,572,177,588,169,617,166,640,156,644,142,623,144,601,136,578,131,555,138" />

                    <polygon data-comunidad="cantabria" class="{{ $clasesPoligono }}"
                        points="642,150,681,142,714,150,697,164,675,177,670,187,650,173,633,173,631,158" />

                    <polygon data-comunidad="navarra" class="{{ $clasesPoligono }}"
                        points="798,245,804,234,802,216,837,183,800,168,800,152,783,150,757,183,751,203,781,224,779,236" />

                    <polygon data-comunidad="pais-vasco" class="{{ $clasesPoligono }}"
                        points="718,148,730,144,765,154,785,144,777,158,759,183,753,205,736,199,720,193,709,181,703,162" />

                    <polygon data-comunidad="la-rioja" class="{{ $clasesPoligono }}"
                        points="724,201,740,210,775,218,779,240,751,232,736,236,716,224" />

                    <polygon data-comunidad="valencia" class="{{ $clasesPoligono }}"
                        points="843,518,829,499,825,479,831,454,816,436,814,417,800,403,818,376,833,378,859,355,857,329,870,323,884,323,901,333,880,372,864,397,868,427,890,450,874,442,894,452,880,468,861,475" />
                </svg>
            </div>

            {{-- Mensaje de resultado (el JS lo rellenará) --}}
            <p id="mensaje" class="mt-6 text-center text-xl font-bold"></p>

        </div>
    </main>

    <x-footer />

    @vite('resources/js/comunidades.js')

</body>

</html>
