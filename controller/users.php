<?php
require "model/users.php";
require "model/create_user.php";
$is_admin = $_SESSION["is_admin"] === true;


const LIST_USERS_ITEMS_PER_PAGE = 20;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {

    // Get the current page number from query params, defaulting to 1 if not set
    $page = cleanString($_GET['page']) ?? 1;

    // Call the getUsers function from the model
    $result = getUsers($pdo, $page, LIST_USERS_ITEMS_PER_PAGE);

    // Check if the result is an array (i.e., users and total count)
    if (is_array($result)) {
        $users = $result['users'];
        $count = $result['total'];
    } else {
        // In case of an error, return the error message
        $errors[] = $result;
    }

    // Send a response as JSON
    header('Content-Type: application/json');
    echo json_encode(['results' => $users, 'count' => $count]);
    exit();
}

require "view/users.php";