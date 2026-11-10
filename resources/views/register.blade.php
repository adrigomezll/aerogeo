@extends('app')

@section('content')
    <main class="relative isolate flex min-h-[calc(100vh-7rem)] items-center overflow-hidden bg-[#001B30] px-5 py-12 text-white sm:px-8 lg:px-12">
        <div aria-hidden="true" class="absolute inset-0 bg-[url('/images/register-background.png')] bg-cover bg-center"></div>
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-[#001B30]/90 via-[#002B49]/75 to-[#001B30]/85"></div>
        <div aria-hidden="true" class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-[#0072CE]/20 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-40 -right-20 h-96 w-96 rounded-full bg-[#FFD100]/10 blur-3xl"></div>

        <div class="relative mx-auto grid w-full max-w-6xl items-center gap-12 lg:grid-cols-[minmax(0,1fr)_30rem] lg:gap-20">
            <section class="hidden flex-col gap-6 lg:flex">
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-semibold text-sky-100">
                    <span aria-hidden="true" class="h-2 w-2 rounded-full bg-[#FFD100]"></span>
                    Aprende. Explora. Despega.
                </span>
                <div class="flex flex-col gap-4">
                    <h1 class="max-w-xl text-5xl font-extrabold leading-tight tracking-tight">
                        Tu próxima aventura empieza aquí
                    </h1>
                    <p class="max-w-lg text-lg leading-relaxed text-slate-200">
                        Crea tu cuenta y súbete a bordo de AeroGeo para descubrir nuevos destinos y aprender jugando.
                    </p>
                </div>
                <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="Avión volando alrededor del planeta, logo de AeroGeo" class="w-72 object-contain drop-shadow-2xl">
            </section>

            <section class="rounded-3xl border border-white/15 bg-white p-6 text-slate-800 shadow-2xl shadow-black/20 sm:p-8">
                <div class="mb-8 flex flex-col gap-2">
                    <div class="flex items-center gap-3 lg:hidden">
                        <img src="{{ asset('images/aeroGeoLogo.png') }}" alt="Logo de AeroGeo" class="h-12 w-12 object-contain">
                        <span class="text-xl font-extrabold text-[#002B49]">AeroGeo</span>
                    </div>
                    <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#0072CE]">Nueva tripulación</span>
                    <h2 class="text-3xl font-extrabold tracking-tight text-[#002B49]">Crea tu cuenta</h2>
                    <p class="text-slate-600">Regístrate para comenzar a explorar.</p>
                </div>

                <form method="POST" action="#" class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-bold text-[#002B49]">Nombre</label>
                        <input id="name" name="name" type="text" autocomplete="name" required placeholder="Tu nombre" class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#0072CE] focus:bg-white focus:ring-2 focus:ring-[#0072CE]/20">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-bold text-[#002B49]">Correo electrónico</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="tu correo@ejemplo.com" class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#0072CE] focus:bg-white focus:ring-2 focus:ring-[#0072CE]/20">
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm font-bold text-[#002B49]">Contraseña</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="••••••••" class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#0072CE] focus:bg-white focus:ring-2 focus:ring-[#0072CE]/20">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="password_confirmation" class="text-sm font-bold text-[#002B49]">Repite la contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="••••••••" class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#0072CE] focus:bg-white focus:ring-2 focus:ring-[#0072CE]/20">
                        </div>
                    </div>

                    <label class="flex items-start gap-3 text-sm leading-relaxed text-slate-600">
                        <input type="checkbox" name="terms" required class="mt-1 h-4 w-4 rounded border-slate-300 text-[#0072CE] accent-[#0072CE] focus:ring-[#0072CE]">
                        <span>Acepto los términos de uso y la política de privacidad de AeroGeo.</span>
                    </label>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-[#FFD100] px-5 py-3.5 font-bold text-[#002B49] shadow-lg shadow-[#002B49]/20 transition hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-[#FFD100] focus:ring-offset-2">
                        Crear mi cuenta
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    ¿Ya tienes una cuenta?
                    <a href="#" class="font-bold text-[#0072CE] transition-colors hover:text-[#005CA8]">Inicia sesión</a>
                </p>
            </section>
        </div>
    </main>
@endsection