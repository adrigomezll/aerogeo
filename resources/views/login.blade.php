<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Accés AeroCrew</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body
    class="bg-[#0b4c74] text-gray-800 min-h-screen flex flex-col font-sans selection:bg-[#ffd000] selection:text-black">

    <!-- Header Navigation -->
    <header class="bg-white py-4 px-6 md:px-12 flex justify-between items-center shadow-md z-10">
        <div class="flex items-center space-x-3">
            <div
                class="w-8 h-8 rounded-full bg-[#0b4c74] flex items-center justify-center text-white font-bold text-sm">
                AG
            </div>
            <div>
                <span class="font-extrabold text-xl tracking-tight text-[#0b4c74] block leading-none">AeroGeo</span>
                <span class="text-[9px] font-bold tracking-widest text-gray-400 uppercase block">Gaming Operations
                    Hub</span>
            </div>
        </div>

        <nav class="hidden md:flex space-x-8 text-sm font-semibold text-gray-600">
            <a href="#" class="hover:text-[#0b4c74] transition">Storytelling</a>
            <a href="#" class="hover:text-[#0b4c74] transition">Equip Creatiu</a>
            <a href="#" class="hover:text-[#0b4c74] transition">Mètriques</a>
        </nav>

        <div class="flex items-center space-x-4">
            <div class="relative inline-block text-left">
                <select
                    class="bg-gray-100 border border-gray-300 text-gray-700 text-xs font-semibold rounded-lg px-3 py-2 pr-6 appearance-none focus:outline-none cursor-pointer">
                    <option>CA (Català)</option>
                    <option>ES (Español)</option>
                    <option>EN (English)</option>
                </select>
                <i
                    class="fa-solid fa-chevron-down absolute right-2 top-3 text-xs text-gray-500 pointer-events-none"></i>
            </div>

            <a href="#"
                class="bg-[#ffd000] hover:bg-yellow-400 text-black font-bold text-xs py-2.5 px-4 rounded-lg flex items-center shadow transition transform hover:-translate-y-0.5">
                <i class="fa-solid fa-ticket mr-2"></i> Embarcar-se
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main
        class="flex-1 flex items-center justify-center p-6 relative overflow-hidden bg-gradient-to-br from-[#073654] via-[#0b4c74] to-[#0288d1]">

        <div class="w-full max-w-md relative z-10 my-8">
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-2xl relative border border-gray-100">

                <div
                    class="absolute top-8 right-8 text-[#0b4c74] text-2xl bg-blue-50 w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-plane-departure"></i>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-black text-[#0b4c74] tracking-tight">AeroCrew</h2>
                    <p class="text-xs text-gray-500 mt-1 font-medium">Introdueix les teves credencials per accedir a la
                        cabina de vol.</p>
                </div>

                <!-- Formulario POST a la ruta de login -->
                <form class="space-y-4">
                    @csrf

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email"
                            class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">
                            CORREU ELECTRÒNIC *
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="pilot@aerogeo.es"
                            class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-[#0b4c74] focus:border-transparent p-3 outline-none transition">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password"
                                class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                CONTRASENYA *
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-[11px] font-semibold text-[#0b4c74] hover:underline">
                                    Has oblidat la contrasenya?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-[#0b4c74] focus:border-transparent p-3 pr-10 outline-none transition">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 text-xs focus:outline-none">
                                <i id="eye-icon" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 text-[#0b4c74] border-gray-300 rounded focus:ring-[#0b4c74]">
                            <span class="text-xs font-semibold text-gray-600">Recorda'm en aquest dispositiu</span>
                        </label>
                    </div>

                    <!-- Botón Submit -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-[#0b4c74] hover:bg-[#073654] text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition transform active:scale-[0.99] flex items-center justify-center text-sm">
                            <i class="fa-solid fa-paper-plane mr-2 text-xs"></i> Iniciar Sessió i Envolar
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-xs font-medium text-gray-500">
                        Encara no tens la teva targeta d'embarcament?
                        <a href="#" class="font-bold text-[#0b4c74] hover:underline ml-1">
                            Registra't ara
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
