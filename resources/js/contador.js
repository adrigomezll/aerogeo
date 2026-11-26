const CLAVE = 'aerogeo_fin_tiempo';
const DURACION = 20; // segundos para comunidad + aeropuerto

// Pone la cuenta atrás a 20 s (se llama en el mapa de comunidades)
export function iniciarContador() {
    sessionStorage.setItem(CLAVE, Date.now() + DURACION * 1000);
}

// Muestra los segundos que quedan y llama a alAcabar cuando lleguen a 0.
// Devuelve una función para parar el contador.
export function arrancarContador(elemento, alAcabar) {
    // Si no hay hora de fin, o ya caducó, empezamos una cuenta nueva
    const guardado = Number(sessionStorage.getItem(CLAVE));
    if (!guardado || guardado <= Date.now()) {
        iniciarContador();
    }

    const fin = Number(sessionStorage.getItem(CLAVE));
    let intervalo = null;

    function parar() {
        clearInterval(intervalo);
    }

    function segundosRestantes() {
        return Math.max(0, Math.ceil((fin - Date.now()) / 1000));
    }

    function actualizar() {
        const restante = segundosRestantes();
        elemento.textContent = restante;

        if (restante === 0) {
            parar();
            alAcabar();
        }
    }

    // Valor inicial (no dispara alAcabar)
    elemento.textContent = segundosRestantes();
    intervalo = setInterval(actualizar, 1000);

    return parar;
}