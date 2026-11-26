<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Iniciar sessió</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: linear-gradient(rgba(0, 33, 57, 0.8), rgba(5, 61, 98, 0.8)), url('{{ asset('images/fondoBarcelona.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-white">

    <x-header />

    <!-- Contenido -->
    <main class="flex-1 w-full max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center">

        <!-- Columna izquierda: login -->
        <div>

            <span class="inline-flex items-center border border-white/20 bg-[#0d2b42] text-xs font-semibold px-4 py-2 rounded-full mb-6">
                <span class="w-2 h-2 bg-[#ffd100] rounded-full mr-2"></span>
                Benvingut a bord
            </span>

            <h1 class="text-4xl md:text-5xl font-black leading-tight mb-2">
                Torna a pujar a l'avió.
            </h1>
            <h2 class="text-4xl md:text-5xl font-black leading-tight text-[#ffd100] mb-8">
                La teva aventura t'espera
            </h2>

            <!-- Tarjeta del formulario -->
            <div class="bg-white text-gray-800 rounded-2xl shadow-2xl p-8 max-w-md">

                {{-- Mensaje tras registrarse --}}
                @if (session('success'))
                    <p class="mb-4 text-sm font-semibold text-green-600">{{ session('success') }}</p>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                    @csrf

                    <!-- Correo electrónico -->
                    <div>
                        <label for="correo" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">
                            CORREU ELECTRÒNIC *
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            value="{{ old('correo') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="pilot@aerogeo.es"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-[#ffd100] p-3 outline-none transition"
                        >
                        @error('correo')
                            <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="contrasena" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                CONTRASENYA *
                            </label>

                            <a href="#" class="text-[11px] font-semibold text-[#0b4c74] hover:underline">
                                Has oblidat la contrasenya?
                            </a>
                        </div>

                        <div class="relative">
                            <input
                                type="password"
                                id="contrasena"
                                name="contrasena"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-[#ffd100] p-3 pr-10 outline-none transition"
                            >

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 text-xs"
                            >
                                <i id="eye-icon" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        @error('contrasena')
                            <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-[#ffd100] hover:bg-yellow-300 text-[#002139] font-extrabold py-3.5 px-4 rounded-full shadow-lg transition flex items-center justify-center text-sm"
                        >
                            <i class="fa-solid fa-paper-plane mr-2 text-xs"></i>
                            Iniciar Sessió i Envolar
                        </button>
                    </div>

                </form>

                <!-- Enlace a registro -->
                <p class="text-center text-xs text-gray-500 mt-6">
                    Encara no tens compte?
                    <a href="{{ route('registro.create') }}" class="font-bold text-[#0b4c74] hover:underline">Registra't</a>
                </p>

            </div>
        </div>

        <!-- Columna derecha: logo -->
        <div class="hidden md:flex justify-center">
            <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="AeroGeo" class="w-80">
        </div>

    </main>

    <x-footer />

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('contrasena');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>