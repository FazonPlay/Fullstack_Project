<?php
/**
 * @var PDO $pdo
 */
require "model/login.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $errors = [];
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (null === $username || null === $password) {
        $errors[] = "The login or password is missing";
    } else {
        $user = login($pdo, $username, $password);

        if (!$user) {
            $errors[] = "User not found";
        }
        elseif (!password_verify($password, $user['password'])) {
            $errors[] = "Invalid password";
        }
        else {
            $_SESSION["auth"] = true;
            $_SESSION["username"] = $user['username'];
            $_SESSION["is_admin"] = (bool)$user['is_admin'];
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
require "view/login.php";

