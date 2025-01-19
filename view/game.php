<?php
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Memory Game</h1>
        <div id="timer" class="text-danger fw-bold">Time: 05:00</div>
    </div>
    <div id="game-board" class="row row-cols-4 g-3">
        <!-- Cards will be dynamically inserted using JavaScript -->
    </div>
</div>
<script src="./assets/js/game.js" type="module"></script>
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
    });
</script>