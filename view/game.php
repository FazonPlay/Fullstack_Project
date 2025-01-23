<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Toast Container -->
        <div id="toast-container"></div>

        <!-- Start Game Button -->

        <h1>Memory Game</h1>
        <div id="timer" class="text-danger fw-bold">Time: 05:00</div>
    </div>
    <div class="progress mb-3">
        <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button id="start-game-btn" class="btn btn-primary">Start Game</button>

    <div id="game-board" class="row row-cols-4 g-3">
        <!-- Cards will be dynamically added here by JavaScript -->
    </div>
</div>

<script src="./assets/js/game.js" type="module"></script>
<script type="module">
    import { initializeGame, isGameLocked} from './assets/js/game.js';

    // Start the game when the page loads
    document.addEventListener('DOMContentLoaded', () => {


        const startGameBtn = document.querySelector('#start-game-btn');
        startGameBtn.addEventListener('click', () => {

            startGameBtn.disabled = true;
            initializeGame();

        });



    });


</script>
