<footer class="border-t border-white/10 bg-[#001B30] text-slate-300">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-5 py-8 sm:px-8 sm:py-10 lg:px-12">
        <div class="flex flex-col gap-8 sm:flex-row sm:items-center sm:justify-between">
            <a href="/" class="flex items-center gap-3 self-start">
                <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="" class="h-14 w-14 object-contain">
                <span class="flex flex-col gap-1">
                    <span class="text-lg font-extrabold tracking-tight text-white">AeroGeo</span>
                    <span class="text-sm text-slate-400">Aprende. Explora. Despega.</span>
                </span>
            </a>

            <nav aria-label="Navegación del pie de página" class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm font-semibold">
                <a href="#storytelling" class="transition-colors hover:text-[#FFD100] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FFD100]">Storytelling</a>
                <a href="#juegos" class="transition-colors hover:text-[#FFD100] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FFD100]">Juegos</a>
                <a href="{{ route('login.form') }}" class="transition-colors hover:text-[#FFD100] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FFD100]">Embarcarse</a>
                <a href="#equipo" class="transition-colors hover:text-[#FFD100] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FFD100]">Equipo</a>
            </nav>
        </div>

        <div class="flex flex-col gap-2 border-t border-white/10 pt-5 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} AeroGeo. Proyecto educativo.</p>
            <p>Hecho para aprender jugando.</p>
        </div>
    </div>
</footer>
