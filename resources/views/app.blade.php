<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Landing Page</title>
    <link rel="icon" type="image/png" href="{{ asset('images/aeroGeoLogo.png') }}">
    <!-- Tailwind CSS desde CDN para maquetación -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --aero-navy: #002B49;   /* Estilo Aena / ENAIRE */
            --aero-yellow: #FFD100; /* Estilo Ryanair */
            --aero-blue: #0072CE;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 flex flex-col min-h-screen">

    {{-- Componente Header --}}
    @include('components.header')

    {{-- Contenido principal --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Componente Footer --}}
    @include('components.footer')

</body>
</html>