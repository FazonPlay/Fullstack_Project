<?php if (!empty($_SESSION['auth'])): ?>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-4">Welcome Back!</h1>
        <p class="lead">Check out your progress and compete for the best time!</p>
    </div>

    <div class="row gy-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Games Played</h5>
                    <p class="card-text display-6">10</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Best Time</h5>
                    <p class="card-text display-6">0:42</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Last Played</h5>
                    <p class="card-text display-6">Jan 26, 2025</p>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4">Welcome, please sign up or login to play!</h1>
            <p class="lead">Check out your progress and compete for the best time!</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">Games Played</h5>
                        <p class="card-text display-6">10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Best Time</h5>
                        <p class="card-text display-6">0:42</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h5 class="card-title">Last Played</h5>
                        <p class="card-text display-6">Jan 26, 2025</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    <div class="mt-5">
        <h2 class="text-center">Top 10 Times</h2>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Time in Seconds</th>
                <th scope="col">Date and Time Played</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($topTen)): ?>
                <?php foreach ($topTen as $entry): ?>
                    <tr>
                        <td><?= htmlspecialchars($entry['username']) ?></td>
                        <td><?= htmlspecialchars($entry['duration']) ?></td>
                        <td><?= htmlspecialchars($entry['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No times recorded yet.</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <?php if (!empty($_SESSION['auth'])): ?>
            <a href="index.php?component=game" class="btn btn-success btn-lg">
                Start New Game
            </a>
        <?php else: ?>
            <a href="index.php?component=login" class="btn btn-success btn-lg">
                Start New Game
            </a>
        <?php endif; ?>
    </div>
</div>
