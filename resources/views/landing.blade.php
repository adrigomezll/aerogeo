@extends('app')

@section('content')

    <section id="storytelling" class="relative isolate overflow-hidden bg-gradient-to-br from-[#001B30] via-[#002B49] to-[#06436A] text-white">
        <div aria-hidden="true" class="absolute -right-32 -top-40 h-96 w-96 rounded-full bg-[#0072CE]/20 blur-3xl"></div>
        <div class="relative mx-auto grid min-h-[32rem] max-w-7xl items-center gap-10 px-5 py-14 sm:px-8 sm:py-16 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-20">
            <div class="flex flex-col items-start gap-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-semibold text-sky-100">
                    <span aria-hidden="true" class="h-2 w-2 rounded-full bg-[#FFD100]"></span>
                    Aprende. Explora. Despega.
                </span>
                <div class="flex flex-col gap-5">
                    <h1 class="max-w-2xl text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                        El mundo es enorme.
                        <span class="text-[#FFD100]">Aprenderlo puede ser una aventura</span>
                    </h1>
                    <p class="max-w-xl text-lg leading-relaxed text-slate-200 sm:text-xl">
                        Súbete a bordo de AeroGeo y descubre juegos educativos inspirados en la navegación aérea y en lugares reales. De las comunidades de España a las calles de Barcelona, cada destino es una nueva misión.
                    </p>
                </div>
                <div class="flex flex-col items-start gap-3 pt-1">
                    <a href="#storytelling" class="inline-flex w-56 items-center justify-center whitespace-nowrap rounded-full border border-[#FFD100] bg-transparent px-4 py-2.5 font-semibold text-[#FFD100] transition-colors hover:bg-[#FFD100]/10">
                        Storytelling
                    </a>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="#juegos" class="inline-flex w-56 items-center justify-center gap-2 whitespace-nowrap rounded-full bg-[#FFD100] px-4 py-3 font-bold text-[#002B49] shadow-lg shadow-black/20 transition hover:bg-yellow-300">
                            Explorar los juegos
                            <span aria-hidden="true">→</span>
                        </a>
                        <span class="text-sm font-medium text-slate-300">Tu próxima aventura empieza aquí</span>
                    </div>
                </div>
            </div>

            <div class="relative mx-auto flex w-full max-w-2xl items-center justify-center">
                <div aria-hidden="true" class="absolute inset-10 rounded-full bg-[#0072CE]/30 blur-3xl"></div>
                <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="Avión volando alrededor del planeta, logo de AeroGeo" class="relative w-full object-contain drop-shadow-2xl">
            </div>
        </div>
    </section>

    <section id="juegos" class="bg-white px-5 py-16 sm:px-8 sm:py-20 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <div class="mb-10 flex flex-col gap-3 sm:mb-12">
                <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#0072CE]">Elige tu destino</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-[#002B49] sm:text-4xl">Nuestros juegos</h2>
                <p class="max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Aprende geografía a tu ritmo: cada juego es una nueva aventura por descubrir.
                </p>
            </div>

            <div class="grid items-stretch gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-52 overflow-hidden bg-[#07395D]">
                        <img src="{{ asset('images/juego-albert.png') }}" alt="Avión con una avería sobrevolando un mapa de España" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <span class="absolute right-5 top-5 rounded-full border border-white/30 bg-[#002B49]/70 px-3 py-1 text-xs font-bold tracking-widest text-white">RUTA 01</span>
                    </div>
                    <div class="flex flex-1 flex-col gap-5 p-6 sm:p-7">
                        <div class="flex flex-col gap-3">
                            <span class="w-fit rounded-full bg-sky-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#0072CE]">Geografía · España</span>
                            <h3 class="text-xl font-bold leading-snug text-[#002B49]">Localización del aterrizaje</h3>
                            <p class="leading-relaxed text-slate-600">Un avión necesita encontrar un lugar seguro para aterrizar. Arrastra los nombres de comunidades autónomas y ciudades hasta su ubicación correcta en el mapa.</p>
                        </div>
                        <button class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#0072CE] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005CA8] focus:outline-none focus:ring-2 focus:ring-[#0072CE] focus:ring-offset-2">
                            Jugar ahora <span aria-hidden="true">→</span>
                        </button>
                    </div>
                </article>

                <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-52 overflow-hidden bg-[#3D214F]">
                        <img src="{{ asset('images/juego-adri.png') }}" alt="Mapa ilustrado de Barcelona con monumentos y pistas para encontrar un motor perdido" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <span class="absolute right-5 top-5 rounded-full border border-white/30 bg-[#351E42]/75 px-3 py-1 text-xs font-bold tracking-widest text-white">RUTA 02</span>
                    </div>
                    <div class="flex flex-1 flex-col gap-5 p-6 sm:p-7">
                        <div class="flex flex-col gap-3">
                            <span class="w-fit rounded-full bg-rose-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-rose-700">Aventura · Barcelona</span>
                            <h3 class="text-xl font-bold leading-snug text-[#002B49]">Búsqueda del motor perdido</h3>
                            <p class="leading-relaxed text-slate-600">Explora Barcelona y visita sus monumentos para seguir las pistas. ¿Podrás descubrir dónde se esconde el motor perdido?</p>
                        </div>
                        <button class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#0072CE] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005CA8] focus:outline-none focus:ring-2 focus:ring-[#0072CE] focus:ring-offset-2">
                            Jugar ahora <span aria-hidden="true">→</span>
                        </button>
                    </div>
                </article>

                <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-52 overflow-hidden bg-[#001B30]">
                        <img src="{{ asset('images/juego-raul.png') }}" alt="Motor de avión dividido en cuatro piezas de colores junto a cofres y una pregunta sobre Barcelona" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <span class="absolute right-5 top-5 rounded-full border border-white/30 bg-[#002B49]/75 px-3 py-1 text-xs font-bold tracking-widest text-white">RUTA 03</span>
                    </div>
                    <div class="flex flex-1 flex-col gap-5 p-6 sm:p-7">
                        <div class="flex flex-col gap-3">
                            <span class="w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-amber-700">Cultura · Barcelona</span>
                            <h3 class="text-xl font-bold leading-snug text-[#002B49]">Reparación del avión</h3>
                            <p class="leading-relaxed text-slate-600">Responde preguntas sobre Barcelona para abrir los cofres y conseguir las cuatro piezas de colores. Después, colócalas en su sitio y repara el motor.</p>
                        </div>
                        <button class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#0072CE] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005CA8] focus:outline-none focus:ring-2 focus:ring-[#0072CE] focus:ring-offset-2">
                            Jugar ahora <span aria-hidden="true">→</span>
                        </button>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section id="embarcar" class="relative isolate overflow-hidden bg-[#001B30] px-5 py-16 sm:px-8 sm:py-20 lg:px-12">
        <div aria-hidden="true" class="absolute -bottom-40 -left-24 h-96 w-96 rounded-full bg-[#0072CE]/20 blur-3xl"></div>
        <div class="relative mx-auto grid max-w-7xl overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-[#07395D] to-[#002B49] shadow-2xl lg:grid-cols-[0.9fr_1.1fr]">
            <div class="flex flex-col justify-between gap-10 p-7 sm:p-10 lg:p-12">
                <div class="flex flex-col items-start gap-6">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[#FFD100]/40 bg-[#FFD100]/10 px-4 py-2 text-sm font-semibold text-[#FFD100]">
                        <span aria-hidden="true">✦</span> Tu próxima aventura te espera
                    </span>
                    <div class="flex flex-col gap-4">
                        <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl">
                            Sube a bordo de <span class="text-[#FFD100]">AeroGeo</span>
                        </h2>
                        <p class="max-w-lg leading-relaxed text-slate-300">
                            Déjanos tus datos y prepárate para descubrir nuevos juegos, destinos e historias. El viaje no ha hecho más que empezar.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4 border-t border-white/10 pt-6">
                    <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="" class="h-14 w-14 object-contain">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">AeroGeo</span>
                        <span class="font-semibold text-white">Aprende. Explora. Despega.</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-7 sm:p-10 lg:p-12">
                <div class="mb-8 flex flex-col gap-2">
                    <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#0072CE]">Tarjeta de embarque</span>
                    <h3 class="text-2xl font-extrabold tracking-tight text-[#002B49]">Reserva tu plaza</h3>
                    <p class="text-sm leading-relaxed text-slate-600">Completa tus datos para recibir novedades de nuestros próximos vuelos.</p>
                </div>

                <form onsubmit="event.preventDefault(); alert('¡Gracias por embarcarte!');" class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <label for="nombre" class="text-sm font-semibold text-slate-700">Nombre y apellidos</label>
                        <input id="nombre" name="nombre" type="text" autocomplete="name" placeholder="¿Cómo te llamas?" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 transition focus:border-[#0072CE] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0072CE]/10">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-semibold text-slate-700">Correo electrónico</label>
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="tu@correo.com" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 transition focus:border-[#0072CE] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0072CE]/10">
                    </div>
                    <button type="submit" class="mt-1 inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#FFD100] px-6 py-3.5 font-bold text-[#002B49] shadow-lg shadow-[#FFD100]/20 transition hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-[#FFD100] focus:ring-offset-2 focus:ring-offset-white">
                        Confirmar embarque <span aria-hidden="true">→</span>
                    </button>
                    <p class="text-center text-xs leading-relaxed text-slate-500">Tus datos se usarán únicamente para esta experiencia de demostración.</p>
                </form>
            </div>
        </div>
    </section>

    <section id="equipo" class="bg-slate-50 px-5 py-16 sm:px-8 sm:py-20 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <div class="mx-auto mb-10 flex max-w-2xl flex-col items-center gap-3 text-center sm:mb-12">
                <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#0072CE]">La tripulación</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-[#002B49] sm:text-4xl">Quiénes hacemos AeroGeo</h2>
                <p class="text-base leading-relaxed text-slate-600 sm:text-lg">
                    Detrás de cada aventura hay un equipo de tres personas con ganas de aprender y crear.
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <article class="group relative flex flex-col items-center gap-4 overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#0072CE] to-[#47B7D8]"></div>
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#E8F4FC] text-2xl font-extrabold text-[#0072CE] ring-4 ring-white shadow-md transition-transform group-hover:scale-105">A</div>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl font-bold text-[#002B49]">Albert</h3>
                        <p class="text-sm font-medium text-slate-500">Tripulación AeroGeo</p>
                    </div>
                </article>

                <article class="group relative flex flex-col items-center gap-4 overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#A34868] to-[#F2A65A]"></div>
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 text-2xl font-extrabold text-[#A34868] ring-4 ring-white shadow-md transition-transform group-hover:scale-105">A</div>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl font-bold text-[#002B49]">Adri</h3>
                        <p class="text-sm font-medium text-slate-500">Tripulación AeroGeo</p>
                    </div>
                </article>

                <article class="group relative flex flex-col items-center gap-4 overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:col-span-2 lg:col-span-1">
                    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#FFD100] to-[#F2A65A]"></div>
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-amber-50 text-2xl font-extrabold text-amber-700 ring-4 ring-white shadow-md transition-transform group-hover:scale-105">R</div>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl font-bold text-[#002B49]">Raúl</h3>
                        <p class="text-sm font-medium text-slate-500">Tripulación AeroGeo</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

@endsection