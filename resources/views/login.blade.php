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

                <form id="loginForm" class="space-y-4">

                    <!-- Correo electrónico -->
                    <div>
                        <label for="email" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">
                            CORREU ELECTRÒNIC *
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            autofocus
                            placeholder="pilot@aerogeo.es"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-[#ffd100] p-3 outline-none transition"
                        >
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                CONTRASENYA *
                            </label>

                            <a href="#" class="text-[11px] font-semibold text-[#0b4c74] hover:underline">
                                Has oblidat la contrasenya?
                            </a>
                        </div>

                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
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
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center pt-1">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 border-gray-300 rounded"
                            >
                            <span class="text-xs font-semibold text-gray-600">
                                Recorda'm en aquest dispositiu
                            </span>
                        </label>
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
                    <a href="#" class="font-bold text-[#0b4c74] hover:underline">Registra't</a>
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
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('La funcionalitat de login encara no està disponible.');
        });
    </script>

</body>
</html>