<header class="sticky top-0 z-50 border-b border-white/10 bg-[#002B49]/95 text-white shadow-lg shadow-[#001B30]/10 backdrop-blur-md">
    <div class="mx-auto flex w-full max-w-7xl flex-col gap-1 px-4 py-2 sm:flex-row sm:items-center sm:justify-between sm:px-8 sm:py-0 lg:px-12">
        <a href="/" class="flex shrink-0 items-center justify-center gap-2 sm:justify-start">
            <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="Logo de AeroGeo" class="h-16 w-auto object-contain sm:h-20">
            <span class="text-xl font-extrabold tracking-tight sm:text-2xl">AeroGeo</span>
        </a>

        <nav aria-label="Navegación principal" class="flex items-center justify-center gap-1 sm:justify-end sm:gap-2">
            <a href="#storytelling" class="rounded-full px-3 py-2 text-sm font-semibold text-slate-200 transition-colors hover:bg-white/10 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FFD100] sm:px-4">
                Storytelling
            </a>
            <label class="sr-only" for="idioma">Idioma</label>
            <select id="idioma" class="cursor-pointer rounded-full border border-white/15 bg-white/10 px-3 py-2 text-sm font-semibold text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-[#FFD100]">
                <option value="es" selected class="text-slate-900">ES</option>
                <option value="ca" class="text-slate-900">CA</option>
                <option value="en" class="text-slate-900">EN</option>
            </select>
            <a href="{{ route('login.form') }}" class="rounded-full bg-[#FFD100] px-4 py-2 text-sm font-bold text-[#002B49] shadow-sm shadow-black/10 transition hover:bg-yellow-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-[#002B49] sm:px-5">
                Embarcarse
            </a>
        </nav>
    </div>
</header>