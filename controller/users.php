<?php
require "model/users.php";
require "model/create_user.php";

$is_admin = $_SESSION["is_admin"] === true;


const LIST_USERS_ITEMS_PER_PAGE = 10;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {

    $page = cleanString($_GET['page']) ?? 1;

    $result = getUsers($pdo, $page, LIST_USERS_ITEMS_PER_PAGE);

    if (is_array($result)) {
        $users = $result['users'];
        $count = $result['total'];
    } else {
        $errors[] = $result;
    }

    header('Content-Type: application/json');
    echo json_encode(['results' => $users, 'count' => $count]);
    exit();

}
if ($_GET['component'] === 'users' && $_GET['action'] === 'delete') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $result = deleteUser($pdo, (int)$_GET['id']);
    }
}

require "view/users.php";