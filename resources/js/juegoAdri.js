console.log('Juego 2 cargado correctamente');

const mapa = document.getElementById('mapaBarcelona');
const investigador = document.getElementById('investigador');
const monumentos = document.querySelectorAll('.monumento');

if(mapa && investigador) {

    console.log('Monumentos encontrados:', monumentos);

    let arrastrando = false;
    let offsetX = 0;
    let offsetY = 0;

    investigador.addEventListener('pointerdown', function(event) {
        arrastrando = true;

        const rectInvestigador  = investigador.getBoundingClientRect();

        offsetX = event.clientX - rectInvestigador.left;
        offsetY = event.clientY - rectInvestigador.top;

        console.log('Investigador cogido');
    })

    document.addEventListener('pointermove', function(event) {
        if(arrastrando) {

            const rectMapa = mapa.getBoundingClientRect();

            let nuevaX = event.clientX - rectMapa.left - offsetX;
            let nuevaY = event.clientY - rectMapa.top - offsetY;

            const anchoInvestigador = investigador.offsetWidth;
            const altoInvestigador = investigador.offsetHeight;

            // Limitar el movimiento dentro del mapa
            nuevaX = Math.max(0, Math.min(nuevaX, rectMapa.width - anchoInvestigador));
            nuevaY = Math.max(0, Math.min(nuevaY, rectMapa.height - altoInvestigador));

            // Actualizamos la posición
            investigador.style.left = (nuevaX / rectMapa.width) * 100 + '%';
            investigador.style.top = (nuevaY / rectMapa.height) * 100 + '%';

            console.log('X:', event.clientX, 'Y:', event.clientY);
        }
    })

    document.addEventListener('pointerup', function() {
        if(arrastrando) {
            arrastrando = false;
            console.log('Investigador soltado');
        }
    });

}
