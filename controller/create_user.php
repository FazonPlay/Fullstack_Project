<?php

global $pdo;
require 'model/create_user.php';

$errors = [];
$action = 'create';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $action = $_POST['action'] ?? 'create';

    if (null === $username || null === $password) {
        $errors[] = "The login or password is missing";
    } else {
        if ($action === 'create') {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userId = create_user($pdo, $username, $hashedPassword);
            if ($userId) {
                header("Content-Type: application/json");
                echo json_encode(['user' => $userId]);
                exit();
            } else {
                $errors[] = "Failed to create user";
            }
        }
    }

    if (!empty($errors)) {
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}

require 'view/create_user.php';


