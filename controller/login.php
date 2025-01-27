<?php
/**
 * @var PDO $pdo
 */
require "model/login.php";

// Ensure session is started

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $errors = [];
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    // Check if both username and password are provided
    if (null === $username || null === $password) {
        $errors[] = "The login or password is missing";
    } else {
        // Call login function to check user credentials
        $user = login($pdo, $username, $password);

        // Check if user exists
        if (!$user) {
            $errors[] = "User not found";
        }
        // Check if password is correct
        elseif (!password_verify($password, $user['password'])) {
            $errors[] = "Invalid password";
        } else {
            // If login is successful, set session variables
            $_SESSION["auth"] = true;
            $_SESSION["username"] = $user['username'];
            $_SESSION["is_admin"] = (bool)$user['is_admin'];
            $_SESSION['user_id'] = $user['id']; // Store user id in session

            // Return success JSON response
            header("Content-Type: application/json");
            echo json_encode(['authentication' => true]);
            exit();
        }
    }

    // If there are any errors, return them in JSON format
    if (!empty($errors)) {
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}

require "view/login.php";
