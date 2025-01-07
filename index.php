<?php
include 'includes/database.php';
include 'includes/auth.php';

if (isset($_GET['disconnect'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    if (!empty($_SESSION['auth'])) {
        $componentName = !empty($_GET['component'])
            ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
            : 'users';

        $actionName = !empty($_GET['action'])
            ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8')
            : null;

        if (file_exists("controller/$componentName.php")) {
            require "controller/$componentName.php";
        } else {
            throw new Exception("Component '$componentName' does not exist");
        }
    } else {
        require "controller/login.php";
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memory Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <?php require "_partials/navbar.php"; ?>
    <?php require "view/dashboard.php"; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>