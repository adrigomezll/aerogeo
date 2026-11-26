import { iniciarContador, arrancarContador } from './contador.js';

const mapa = document.getElementById('mapa');
const comunidades = document.querySelectorAll('#mapa polygon');
const mensaje = document.getElementById('mensaje');
const tiempo = document.getElementById('tiempo');

let terminado = false;

// Aquí empieza la cuenta atrás
iniciarContador();
arrancarContador(tiempo, function () {
    terminado = true;
    mensaje.textContent = 'Se acabó el tiempo. No has encontrado tu destino.';
    mensaje.className = 'mt-6 text-center text-xl font-bold text-red-400';
});

comunidades.forEach(function (comunidad) {

    comunidad.addEventListener('click', function () {
        if (terminado) return;

        if (comunidad.dataset.comunidad === mapa.dataset.correcta) {
            terminado = true; // evita más clics mientras esperamos
            mensaje.textContent = '¡Correcto! Rumbo al aeropuerto...';
            mensaje.className = 'mt-6 text-center text-xl font-bold text-green-400';

            // El contador NO se para: sigue en la siguiente pantalla
            setTimeout(function () {
                window.location.href = mapa.dataset.siguiente;
            }, 1500);
        } else {
            mensaje.textContent = 'Incorrecto. Ese no es el rumbo, prueba otra comunidad.';
            mensaje.className = 'mt-6 text-center text-xl font-bold text-red-400';
        }
    });
});