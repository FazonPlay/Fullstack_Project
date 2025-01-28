<?php
require "model/times.php";
$is_admin = $_SESSION["is_admin"] === true;

const LIST_TIMES_ITEMS_PER_PAGE = 10;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $page = cleanString($_GET['page']) ?? 1;

    $result = getTimes($pdo, $page, LIST_TIMES_ITEMS_PER_PAGE);

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

if ($_GET['component'] === 'users' && $_GET['action'] === 'delete') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $result = deleteUser($pdo, (int)$_GET['id']);
    }
}
$times = getTimes($pdo);

require "view/times.php";


