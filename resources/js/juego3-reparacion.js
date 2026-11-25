(function () {
    'use strict';

    var COLORS = ['red', 'green', 'blue', 'yellow'];
    var COLOR_NAMES = { red: 'rojo', green: 'verde', blue: 'azul', yellow: 'amarillo' };

    var PIECE_TYPES = [
        { shape: 'square', label: 'Cuadrada', symbol: '◼' },
        { shape: 'circle', label: 'Redonda', symbol: '●' }
    ];

    var levels = [
        {
            piecesNeeded: 3, time: 0, placementTime: 0,
            title: 'Nivel 1 – Reparación del motor',
            instructions: 'Abre un cofre, responde la pregunta, elige una pieza y colócala en su hueco del motor. Tómate tu tiempo.'
        },
        {
            piecesNeeded: 3, time: 90, placementTime: 0,
            title: 'Nivel 2 – ¡El avión despega pronto!',
            instructions: '¡Date prisa! El avión tiene que despegar. Tienes 90 segundos para colocar 3 piezas.'
        },
        {
            piecesNeeded: 2, time: 0, placementTime: 10,
            title: 'Nivel 3 – ¡No se te caiga!',
            instructions: 'Tienes 10 segundos para colocar cada pieza después de conseguirla, o se te caerá.'
        }
    ];

    var questions = [
        { q: '¿Cómo se llama la famosa iglesia diseñada por Antoni Gaudí?', a: ['La Sagrada Familia', 'La Catedral de Girona', 'El Camp Nou'], correct: 0 },
        { q: '¿En qué año comenzaron las obras de la Sagrada Familia?', a: ['1882', '1920', '1750'], correct: 0 },
        { q: '¿Qué arquitecto diseñó el Park Güell?', a: ['Antoni Gaudí', 'Salvador Dalí', 'Pablo Picasso'], correct: 0 },
        { q: '¿Cómo se llama la famosa calle peatonal del centro de Barcelona?', a: ['La Rambla', 'Paseo de Gracia', 'Diagonal'], correct: 0 },
        { q: '¿Qué equipo de fútbol juega en el Camp Nou?', a: ['FC Barcelona', 'Real Betis', 'Valencia CF'], correct: 0 },
        { q: '¿Qué mar baña las playas de Barcelona?', a: ['Mar Mediterráneo', 'Mar Cantábrico', 'Mar Negro'], correct: 0 },
        { q: '¿En qué sierra se encuentra el Tibidabo?', a: ['Sierra de Collserola', 'Montserrat', 'Los Pirineos'], correct: 0 },
        { q: '¿Qué barrio histórico está en el centro de Barcelona?', a: ['Barrio Gótico', 'Malasaña', 'Albaicín'], correct: 0 },
        { q: '¿Qué edificio modernista diseñó Gaudí en el Paseo de Gracia?', a: ['Casa Batlló', 'Palacio Real', 'Torre Glòries'], correct: 0 },
        { q: '¿Cómo se llama el estadio del FC Barcelona?', a: ['Camp Nou', 'Santiago Bernabéu', 'Mestalla'], correct: 0 },
        { q: '¿Qué montaña sagrada está cerca de Barcelona?', a: ['Montserrat', 'Teide', 'Aneto'], correct: 0 },
        { q: '¿En qué año se celebraron los Juegos Olímpicos en Barcelona?', a: ['1992', '1980', '2008'], correct: 0 }
    ];

    // ---------- ESTADO ----------
    var levelIndex = 0;
    var placed = {};              // { "red-circle": true }
    var placedCount = 0;
    var availablePieces = [];     // inventario

    var selectedPieceId = null;
    var activePlacementPieceId = null;
    var usedQuestions = [];

    var seconds = 0;
    var placementSeconds = 0;
    var timerInterval = null;
    var placementInterval = null;
    var toastTimeout = null;

    var questionLocked = false;
    var currentChestColor = null;
    var gameEnded = false;

    function $(id) { return document.getElementById(id); }
    function keyOf(color, shape) { return color + '-' + shape; }
    function currentLevel() { return levels[levelIndex]; }

    function shuffle(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var tmp = array[i]; array[i] = array[j]; array[j] = tmp;
        }
        return array;
    }

    function inInventory(k) {
        return availablePieces.some(function (p) { return p.key === k; });
    }

    // La pieza sigue en el cofre si no está colocada ni la llevamos encima
    function isAvailable(color, shape) {
        var k = keyOf(color, shape);
        return !placed[k] && !inInventory(k);
    }

    function chestHasPieces(color) {
        return PIECE_TYPES.some(function (t) { return isAvailable(color, t.shape); });
    }

    function showToast(message, type) {
        var toast = $('toast');
        toast.textContent = message;
        toast.className = 'toast show' + (type ? ' ' + type : '');
        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(function () { toast.classList.remove('show'); }, 2300);
    }

    // ---------- INTERFAZ ----------
    function updateHints() {
        document.querySelectorAll('.drop-zone').forEach(function (zone) {
            zone.classList.remove('hint');
        });
        if (!selectedPieceId) return;
        var piece = availablePieces.filter(function (p) { return p.id === selectedPieceId; })[0];
        if (!piece) return;
        var zone = document.querySelector('.drop-zone[data-color="' + piece.color + '"][data-shape="' + piece.shape + '"]');
        if (zone && !zone.classList.contains('filled')) zone.classList.add('hint');
    }

    function updateInterface() {
        var level = currentLevel();
        $('level-title').textContent = level.title;
        $('progress').textContent = placedCount + '/' + level.piecesNeeded;

        document.querySelectorAll('.chest-slot').forEach(function (slot) {
            var color = slot.dataset.color;
            var btn = slot.querySelector('.chest-open');
            var has = chestHasPieces(color);
            var holding = activePlacementPieceId !== null;

            slot.classList.toggle('locked', !has || holding || gameEnded);

            if (!has) btn.textContent = '✔ Vacío';
            else if (holding) btn.textContent = '✋ Coloca la pieza';
            else btn.textContent = '🔓 Abrir cofre';
        });

        updateHints();
    }

    function updateTimer() {
        var timer = $('timer');
        var level = currentLevel();
        timer.classList.remove('timer-danger');

        if (level.time > 0) {
            timer.textContent = Math.max(seconds, 0) + 's';
            if (seconds <= 15) timer.classList.add('timer-danger');
        } else if (level.placementTime > 0) {
            if (placementSeconds > 0) {
                timer.textContent = placementSeconds + 's para colocar';
                timer.classList.add('timer-danger');
            } else {
                timer.textContent = 'Consigue una pieza';
            }
        } else {
            timer.textContent = 'Sin límite';
        }
    }

    // ---------- NIVEL ----------
    function startLevel() {
        clearInterval(timerInterval);
        clearInterval(placementInterval);
        clearTimeout(toastTimeout);

        var level = currentLevel();

        gameEnded = false;
        placed = {};
        placedCount = 0;
        availablePieces = [];
        selectedPieceId = null;
        activePlacementPieceId = null;
        usedQuestions = [];
        seconds = level.time;
        placementSeconds = 0;
        questionLocked = false;
        currentChestColor = null;

        document.querySelectorAll('.drop-zone').forEach(function (zone) {
            zone.classList.remove('filled', 'drag-over', 'hint');
        });

        $('question-modal').classList.remove('show');
        $('end-modal').classList.remove('show');
        $('toast').classList.remove('show');
        $('question-phase').style.display = 'block';
        $('piece-choice').classList.remove('show');
        $('feedback').textContent = '';
        $('instructions').textContent = level.instructions;

        renderPieces();
        updateInterface();
        updateTimer();

        if (level.time > 0) {
            showToast('⏱ ¡El avión tiene que despegar pronto!', 'warn');
            timerInterval = setInterval(function () {
                seconds--;
                updateTimer();
                if (seconds <= 0) {
                    clearInterval(timerInterval);
                    showEnd(false);
                }
            }, 1000);
        }
    }

    // ---------- COFRES Y PREGUNTAS ----------
    function openChest(color) {
        if (gameEnded || questionLocked) return;

        if (activePlacementPieceId !== null) {
            showToast('Primero coloca la pieza que tienes en la mano.', 'warn');
            return;
        }
        if (!chestHasPieces(color)) {
            showToast('Este cofre ya está vacío.', 'warn');
            return;
        }

        currentChestColor = color;

        var pool = [];
        for (var i = 0; i < questions.length; i++) {
            if (usedQuestions.indexOf(i) === -1) pool.push(i);
        }
        if (pool.length === 0) {
            usedQuestions = [];
            for (var j = 0; j < questions.length; j++) pool.push(j);
        }

        var qIndex = pool[Math.floor(Math.random() * pool.length)];
        usedQuestions.push(qIndex);
        var question = questions[qIndex];

        $('modal-title').textContent = '🔐 Cofre ' + COLOR_NAMES[color] + ' bloqueado';
        $('question-phase').style.display = 'block';
        $('piece-choice').classList.remove('show');
        $('question-text').textContent = question.q;
        $('feedback').textContent = '';

        var answersBox = $('answers');
        answersBox.innerHTML = '';

        var answers = shuffle(question.a.map(function (text, index) {
            return { text: text, index: index };
        }));

        answers.forEach(function (answer) {
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'answer';
            button.textContent = answer.text;
            button.addEventListener('click', function () {
                answerQuestion(answer.index === question.correct, button);
            });
            answersBox.appendChild(button);
        });

        $('question-modal').classList.add('show');
    }

    function answerQuestion(isCorrect, clickedButton) {
        if (questionLocked) return;

        var feedback = $('feedback');

        if (isCorrect) {
            questionLocked = true;
            feedback.textContent = '¡Correcto! El cofre se abre…';
            feedback.style.color = '#72e69a';
            clickedButton.classList.add('correct');
            document.querySelectorAll('.answer').forEach(function (b) { b.disabled = true; });
            setTimeout(showPieceChoice, 700);
        } else {
            feedback.textContent = 'Incorrecto. El cofre sigue cerrado, prueba otra respuesta.';
            feedback.style.color = '#ff7777';
            clickedButton.classList.add('wrong');
            clickedButton.disabled = true;
        }
    }

    function showPieceChoice() {
        if (!currentChestColor) return;

        $('modal-title').textContent = '🧰 Cofre ' + COLOR_NAMES[currentChestColor] + ' abierto';
        $('question-phase').style.display = 'none';

        var row = $('choice-row');
        row.innerHTML = '';

        PIECE_TYPES.forEach(function (type) {
            if (!isAvailable(currentChestColor, type.shape)) return;

            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'choice-btn ' + currentChestColor + ' shape-' + type.shape;

            var symbol = document.createElement('span');
            symbol.style.fontSize = '28px';
            symbol.textContent = type.symbol;

            var label = document.createElement('span');
            label.textContent = type.label;

            button.appendChild(symbol);
            button.appendChild(label);
            button.addEventListener('click', function () { selectPieceFromChest(type.shape); });
            row.appendChild(button);
        });

        $('piece-choice').classList.add('show');
    }

    function selectPieceFromChest(shape) {
        if (!currentChestColor || !questionLocked) return;

        var color = currentChestColor;
        if (!isAvailable(color, shape)) return;

        var type = PIECE_TYPES.filter(function (t) { return t.shape === shape; })[0];

        var piece = {
            id: Date.now() + '-' + Math.random(),
            key: keyOf(color, shape),
            color: color,
            shape: shape,
            symbol: type.symbol
        };

        availablePieces.push(piece);
        selectedPieceId = piece.id;

        $('question-modal').classList.remove('show');
        $('piece-choice').classList.remove('show');
        $('question-phase').style.display = 'block';

        currentChestColor = null;
        questionLocked = false;

        if (currentLevel().placementTime > 0) {
            startPlacementTimer(piece.id);
        }

        renderPieces();
        updateInterface();
        showToast('¡Pieza conseguida! Llévala a su hueco del motor.');
    }

    function cancelQuestion() {
        if (questionLocked) return;
        $('question-modal').classList.remove('show');
        currentChestColor = null;
    }

    // ---------- INVENTARIO ----------
    function renderPieces() {
        var container = $('pieces');
        container.innerHTML = '';

        if (availablePieces.length === 0) {
            container.innerHTML = '<span class="empty-msg">Todavía no tienes ninguna pieza. Abre un cofre.</span>';
            updateHints();
            return;
        }

        availablePieces.forEach(function (piece) {
            var el = document.createElement('div');
            el.className = 'piece ' + piece.color + ' shape-' + piece.shape;
            el.dataset.id = piece.id;
            el.draggable = true;
            el.textContent = piece.symbol;

            if (piece.id === selectedPieceId) el.classList.add('selected');
            if (piece.id === activePlacementPieceId && placementSeconds > 0) el.classList.add('expiring');

            el.addEventListener('dragstart', function (event) {
                if (gameEnded) { event.preventDefault(); return; }
                selectedPieceId = piece.id;
                event.dataTransfer.setData('text/plain', piece.id);
                event.dataTransfer.effectAllowed = 'move';
                updateHints();
            });

            el.addEventListener('click', function () {
                if (gameEnded) return;
                selectedPieceId = piece.id;
                renderPieces();
            });

            container.appendChild(el);
        });

        updateHints();
    }

    // ---------- TEMPORIZADOR DE COLOCACIÓN (NIVEL 3) ----------
    function startPlacementTimer(pieceId) {
        clearInterval(placementInterval);

        activePlacementPieceId = pieceId;
        placementSeconds = currentLevel().placementTime;

        updateTimer();
        updateInterface();
        renderPieces();

        placementInterval = setInterval(function () {
            placementSeconds--;
            updateTimer();

            if (placementSeconds <= 0) {
                clearInterval(placementInterval);

                availablePieces = availablePieces.filter(function (p) { return p.id !== pieceId; });
                activePlacementPieceId = null;
                selectedPieceId = null;

                showToast('¡Se te ha caído la pieza! Ha vuelto al cofre.', 'error');
                $('instructions').textContent = '¡Se te ha caído la pieza! Vuelve a abrir el cofre.';

                renderPieces();
                updateTimer();
                updateInterface();
            } else {
                renderPieces();
            }
        }, 1000);
    }

    // ---------- COLOCAR ----------
    function placePiece(id, targetColor, targetShape) {
        if (gameEnded) return;

        var piece = availablePieces.filter(function (p) { return p.id === id; })[0];
        if (!piece) return;

        if (piece.color !== targetColor || piece.shape !== targetShape) {
            showToast('¡Esa pieza no va ahí! Busca el hueco de su color y su forma.', 'error');
            return;
        }

        clearInterval(placementInterval);
        placementSeconds = 0;
        activePlacementPieceId = null;

        availablePieces = availablePieces.filter(function (p) { return p.id !== id; });
        placed[piece.key] = true;
        placedCount++;
        selectedPieceId = null;

        var zone = document.querySelector('.drop-zone[data-color="' + targetColor + '"][data-shape="' + targetShape + '"]');
        if (zone) {
            zone.classList.remove('drag-over', 'hint');
            zone.classList.add('filled');
        }

        renderPieces();
        updateInterface();
        updateTimer();

        if (placedCount >= currentLevel().piecesNeeded) {
            clearInterval(timerInterval);
            showToast('¡Última pieza colocada!');
            setTimeout(function () { showEnd(true); }, 800);
        } else {
            showToast('¡Pieza colocada correctamente!');
            if (currentLevel().placementTime > 0) {
                $('instructions').textContent = '¡Bien colocada! Consigue la siguiente pieza.';
            }
        }
    }

    // ---------- FIN DE NIVEL ----------
    function showEnd(won) {
        if (gameEnded) return;
        gameEnded = true;

        clearInterval(timerInterval);
        clearInterval(placementInterval);

        $('question-modal').classList.remove('show');

        $('end-title').textContent = won ? '🎉 ¡Motor reparado!' : '⏰ ¡Se ha acabado el tiempo!';
        $('end-text').textContent = won
            ? 'Has completado el nivel ' + (levelIndex + 1) + '. ¡Buen trabajo!'
            : 'No has conseguido reparar el motor a tiempo. ¡Inténtalo de nuevo!';

        var button = $('next-button');
        button.textContent = won
            ? (levelIndex >= levels.length - 1 ? 'Terminar juego' : 'Siguiente nivel')
            : 'Reintentar';
        button.dataset.won = won ? 'true' : 'false';

        updateInterface();
        $('end-modal').classList.add('show');
    }

    // ---------- EVENTOS ----------
    function initEvents() {
        document.querySelectorAll('.chest-slot').forEach(function (slot) {
            slot.querySelectorAll('button').forEach(function (btn) {
                btn.addEventListener('click', function () { openChest(slot.dataset.color); });
            });
        });

        document.querySelectorAll('.drop-zone').forEach(function (zone) {
            zone.addEventListener('dragover', function (event) {
                if (gameEnded) return;
                event.preventDefault();
                zone.classList.add('drag-over');
            });

            zone.addEventListener('dragleave', function () { zone.classList.remove('drag-over'); });

            zone.addEventListener('drop', function (event) {
                event.preventDefault();
                zone.classList.remove('drag-over');
                var id = event.dataTransfer.getData('text/plain');
                placePiece(id, zone.dataset.color, zone.dataset.shape);
            });

            zone.addEventListener('click', function () {
                if (selectedPieceId !== null) {
                    placePiece(selectedPieceId, zone.dataset.color, zone.dataset.shape);
                } else {
                    showToast('Primero consigue una pieza abriendo un cofre.', 'warn');
                }
            });
        });

        $('btn-cancel').addEventListener('click', cancelQuestion);

        $('btn-restart').addEventListener('click', function () {
            if (confirm('¿Quieres reiniciar este nivel?')) startLevel();
        });

        $('next-button').addEventListener('click', function () {
            var result = this.dataset.won;
            $('end-modal').classList.remove('show');

            if (result === 'final') {
                levelIndex = 0;
                startLevel();
                return;
            }

            if (result !== 'true') {
                startLevel();
                return;
            }

            if (levelIndex >= levels.length - 1) {
                $('end-title').textContent = '🏆 ¡Avión reparado!';
                $('end-text').textContent = '¡Enhorabuena! Has superado los tres niveles y has reparado el motor del avión.';
                this.textContent = 'Volver a jugar';
                this.dataset.won = 'final';
                $('end-modal').classList.add('show');
                return;
            }

            levelIndex++;
            startLevel();
        });
    }

    initEvents();
    startLevel();
})();