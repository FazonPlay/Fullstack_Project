<?php
/**
 * @var PDO $pdo
 */
require_once("includes/auth.php");

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){
    $errors = [];
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if(null === $username || null === $password) {
        $errors[] = "The login or password is missing";
    } else {
        $connect = login($pdo, $username, $password);

        if (empty($connect) || !password_verify($password, $connect['password'])) {
            $errors[] = "Erreur d'identification, veuillez essayer à nouveau";
        } elseif(0 === $connect['enabled']) {
            $errors[] = "Ce compte est désactivé";
        } else {
            $_SESSION["auth"] = true;
            $_SESSION["username"] = $connect['username'];
            header("Content-Type: application/json");
            echo json_encode(['authentication' => true]);
            exit();
        }
    }

    if (!empty($errors)) {
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}

require("view/login.php");