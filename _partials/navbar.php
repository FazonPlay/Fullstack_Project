<?php if (!empty($_SESSION['auth'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Memory Game</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['is_admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?component=users">Admin Panel</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="?disconnect=true">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
<?php else: ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Memory Game</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=login">Login</a>
                </li>
            </ul>
        </div>
    </nav>
<?php endif; ?>
