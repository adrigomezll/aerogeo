import { arrancarContador } from './contador.js';

const destino = document.getElementById('destino');
const zonas = document.querySelectorAll('.zona-destino');
const mensaje = document.getElementById('mensaje');
const botonValidar = document.getElementById('validar');
const tiempo = document.getElementById('tiempo');
const mapa = document.getElementById('mapa');

// 1. Temporizador: continúa el que empezó en el mapa de comunidades
const pararContador = arrancarContador(tiempo, function () {
    terminarPartida();
    mensaje.textContent = 'Se acabó el tiempo. No has podido aterrizar.';
    mensaje.className = 'mt-6 text-center text-xl font-bold text-red-400';
});

// Bloquea el juego cuando termina la partida
function terminarPartida() {
    pararContador();
    destino.draggable = false;
    botonValidar.disabled = true;
}

// 2. Empezar a arrastrar el nombre
destino.addEventListener('dragstart', function (evento) {
    evento.dataTransfer.setData('text/plain', 'destino');
});

// 3. Preparar cada recuadro para recibir el nombre
zonas.forEach(function (zona) {

    zona.addEventListener('dragover', function (evento) {
        evento.preventDefault();
    });

    zona.addEventListener('drop', function (evento) {
        evento.preventDefault();

        if (zona.children.length === 0) {
            zona.appendChild(destino);
        }
    });
});

// 4. Al pulsar el botón, comprobamos la respuesta
botonValidar.addEventListener('click', function () {
    const recuadro = destino.parentElement;

    if (!recuadro.classList.contains('zona-destino')) {
        mensaje.textContent = 'Arrastra primero el nombre a una pista.';
        mensaje.className = 'mt-6 text-center text-xl font-bold text-white';
        return;
    }

    if (destino.dataset.aeropuerto === recuadro.dataset.aeropuerto) {
        terminarPartida();
        mensaje.className = 'mt-6 text-center text-xl font-bold text-green-400';

        if (mapa.dataset.siguiente) {
            // Hay otro nivel: esperamos 1,5 segundos y vamos a su mapa de comunidades
            mensaje.textContent = '¡Correcto! Has aterrizado en ' + recuadro.dataset.aeropuerto +
                '. Preparando el nivel ' + mapa.dataset.nivelSiguiente + '...';

            setTimeout(function () {
                window.location.href = mapa.dataset.siguiente;
            }, 1500);
        } else {
            // Último nivel
            mensaje.textContent = '¡Correcto! Has aterrizado en ' + recuadro.dataset.aeropuerto +
                '. ¡Has completado todos los niveles!';
        }
    } else {
        mensaje.textContent = 'Incorrecto. Esa no es la pista de ' + destino.dataset.aeropuerto;
        mensaje.className = 'mt-6 text-center text-xl font-bold text-red-400';
    }
});