<?php if (!empty($_SESSION['auth'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Memory Game</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>

                <li class="nav-item">
                        <a href="index.php?component=admin" class="btn btn-primary">Admin Panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=users">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=times">Manage Times</a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=game">Play the Game</a>
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?disconnect=true">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
<?php elseif (!isset($_SESSION['auth'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Memory Game</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=login">Login</a>
                </li>
            </ul>
        </div>
    </nav>
<?php endif; ?>
