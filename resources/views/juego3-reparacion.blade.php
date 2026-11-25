<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroGeo - Reparación del avión</title>
    @vite(['resources/css/juego3-reparacion.css', 'resources/js/juego3-reparacion.js'])
</head>
<body>

<div class="bg" style="background-image:url('{{ asset('images/fondo.png') }}')"></div>

<div class="aerogeo-game">

    <header class="topbar">
        <div class="logo">✈ AEROGEO</div>
        <div class="stats">
            <span>🧩 Piezas: <span id="progress">0/3</span></span>
            <span>⏱ <span id="timer">Sin límite</span></span>
        </div>
    </header>

    <main class="game-container">

        <div class="level-info">
            <div>
                <h1 id="level-title">Nivel 1 – Reparación del motor</h1>
                <div class="instructions" id="instructions"></div>
            </div>
            <button class="primary-button" id="btn-restart" type="button">Reiniciar nivel</button>
        </div>

        <section class="board" id="board">

            <img class="scene" src="{{ asset('images/fondo.png') }}" alt="Taller con el motor desmontado" draggable="false">

            <!-- Tinte amarillo del cofre izquierdo -->
            <div class="chest-tint" style="left:8.4%; top:64.5%; width:18.7%; height:22.5%; background-image:url('{{ asset('images/fondo.png') }}');"></div>

            <!-- COFRES -->
            <div class="chest-slot" data-color="yellow" style="left:8.4%; width:18.7%;">
                <button class="chest-hit" type="button" aria-label="Abrir cofre amarillo"></button>
                <button class="chest-open" type="button">🔓 Abrir cofre</button>
            </div>

            <div class="chest-slot" data-color="red" style="left:30.5%; width:17.1%;">
                <button class="chest-hit" type="button" aria-label="Abrir cofre rojo"></button>
                <button class="chest-open" type="button">🔓 Abrir cofre</button>
            </div>

            <div class="chest-slot" data-color="green" style="left:53.9%; width:17%;">
                <button class="chest-hit" type="button" aria-label="Abrir cofre verde"></button>
                <button class="chest-open" type="button">🔓 Abrir cofre</button>
            </div>

            <div class="chest-slot" data-color="blue" style="left:74.3%; width:18.6%;">
                <button class="chest-hit" type="button" aria-label="Abrir cofre azul"></button>
                <button class="chest-open" type="button">🔓 Abrir cofre</button>
            </div>

            <!-- HUECOS DEL MOTOR -->
            <div class="drop-zone" data-color="red"    data-shape="circle" style="left:33.4%; top:18.6%; width:5.2%; height:9.3%;"></div>
            <div class="drop-zone" data-color="red"    data-shape="square" style="left:35.8%; top:42.3%; width:4.6%; height:8.2%;"></div>

            <div class="drop-zone" data-color="green"  data-shape="circle" style="left:50.8%; top:19.1%; width:3.5%; height:6.2%;"></div>
            <div class="drop-zone" data-color="green"  data-shape="square" style="left:50.5%; top:43.2%; width:3.5%; height:6.3%;"></div>

            <div class="drop-zone" data-color="blue"   data-shape="circle" style="left:59.1%; top:23.5%; width:3.5%; height:6.2%;"></div>
            <div class="drop-zone" data-color="blue"   data-shape="square" style="left:59.3%; top:38.4%; width:3.5%; height:6.2%;"></div>

            <div class="drop-zone" data-color="yellow" data-shape="circle" style="left:58.9%; top:12.9%; width:4.2%; height:7.5%;"></div>
            <div class="drop-zone" data-color="yellow" data-shape="square" style="left:65.4%; top:13.8%; width:3.5%; height:6.3%;"></div>

        </section>

        <section class="piece-tray">
            <h3>🔧 Piezas conseguidas</h3>
            <div class="pieces" id="pieces"></div>
            <div class="help">
                Arrastra la pieza hasta su hueco en el motor (mismo color y misma forma). También puedes seleccionarla y pulsar el hueco.
            </div>
        </section>

    </main>

    <div class="toast" id="toast"></div>

    <!-- Modal de preguntas -->
    <div class="modal" id="question-modal">
        <div class="modal-content">
            <h2 id="modal-title">🔐 Cofre bloqueado</h2>

            <div id="question-phase">
                <div class="question" id="question-text"></div>
                <div class="answers" id="answers"></div>
                <div class="feedback" id="feedback"></div>
                <button class="cancel-btn" id="btn-cancel" type="button">Cancelar</button>
            </div>

            <div class="piece-choice" id="piece-choice">
                <h3>Elige la pieza que quieres:</h3>
                <div class="choice-row" id="choice-row"></div>
            </div>
        </div>
    </div>

    <!-- Modal de final -->
    <div class="modal" id="end-modal">
        <div class="modal-content">
            <h2 id="end-title">¡Nivel completado!</h2>
            <p id="end-text"></p>
            <button class="primary-button" id="next-button" type="button">Siguiente nivel</button>
        </div>
    </div>

</div>

</body>
</html>