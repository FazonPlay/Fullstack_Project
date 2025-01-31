<?php
require "model/times.php";


$is_admin = $_SESSION["is_admin"] === true;


const LIST_USERS_ITEMS_PER_PAGE = 10;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && $is_admin) {
        $user_id = intval($_POST['id']);
        $delete_result = deleteTime($pdo, $user_id);

        header('Content-Type: application/json');
        echo json_encode(['success' => $delete_result]);
        exit();
    }

    $page = cleanString($_GET['page'] ?? '1');

    $result = getTimes($pdo, $page, LIST_USERS_ITEMS_PER_PAGE);

    if (is_array($result)) {
        $times = $result['times'];
        $count = $result['total'];
    } else {
        $errors[] = $result;
    }

    header('Content-Type: application/json');
    echo json_encode(['results' => $times, 'count' => $count]);
    exit();



}

require "view/times.php";