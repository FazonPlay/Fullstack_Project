<!--<div class="container mt-5">-->
<!--    <div class="d-flex justify-content-between align-items-center mb-3">-->
<!--        <h1>Memory Game</h1>-->
<!--        <div id="timer" class="text-danger fw-bold">Time: 05:00</div>-->
<!--    </div>-->
<!--    <div id="game-board" class="row row-cols-4 g-3">-->
<!--        Cards will be dynamically inserted using JavaScript -->-->
<!--    </div>-->
<!--</div>-->
<!--<script src="./assets/js/game.js" type="module"></script>-->
<!--<script type="module">-->
<!--    import { startGame } from "./assets/js/game.js";-->
<!--    document.addEventListener('DOMContentLoaded', () => {-->
<!--        startGame();-->
<!--    });-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
</head>
<body>
<h1>Welcome to the Memory Game</h1>
<div id="game-board">
    <!-- Game board will be dynamically populated by game.js -->
</div>
<button id="start-game">Start Game</button>
<div id="timer">Time: 0s</div>

<!-- Link to game.js -->
<script src="./assets/js/game.js"></script>
</body>
</html>

<script type="module">
    import { startGame } from "./assets/js/game.js";
    document.addEventListener('DOMContentLoaded', () => {
        startGame();
    });
