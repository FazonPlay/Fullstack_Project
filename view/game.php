<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div id="toast-container">
        </div>

        <h1 class="mx-auto ">Memory Game</h1>
        <div id="timer" class="text-danger fw-bold">Time: 02:30</div>
    </div>

    <div class="progress mb-3" id="progress">
        <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div class="d-flex justify-content-center mb-3">
        <button id="start-game-btn" class="btn btn-primary">Start Game</button>
    </div>

    <div id="game-board">

    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="./assets/js/main.js" type="module"></script>
<script type="module">

    import { initializeGame} from './assets/js/main.js';

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('#timer').classList.add('d-none');
        document.querySelector('#progress').classList.add('d-none');
        const startGameBtn = document.querySelector('#start-game-btn');
        startGameBtn.addEventListener('click', () => {

            startGameBtn.disabled = true;
            initializeGame();

        });

    });


</script>
