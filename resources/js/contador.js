const CLAVE = 'aerogeo_fin_tiempo';
const DURACION = 20; // segundos para comunidad + aeropuerto

// Pone la cuenta atrás a cero (se llama en el mapa de comunidades)
export function iniciarContador() {
    sessionStorage.setItem(CLAVE, Date.now() + DURACION * 1000);
}

// Muestra los segundos que quedan y llama a alAcabar cuando lleguen a 0.
// Devuelve una función para parar el contador.
export function arrancarContador(elemento, alAcabar) {
    // Por si se entra directamente a una pantalla sin pasar por comunidades
    if (!sessionStorage.getItem(CLAVE)) {
        iniciarContador();
    }

    const fin = Number(sessionStorage.getItem(CLAVE));
    let intervalo = null;

    function parar() {
        clearInterval(intervalo);
    }

    function actualizar() {
        const restante = Math.max(0, Math.ceil((fin - Date.now()) / 1000));
        elemento.textContent = restante;

        if (restante === 0) {
            parar();
            alAcabar();
        }
    }

    intervalo = setInterval(actualizar, 1000);
    actualizar();

    return parar;
}