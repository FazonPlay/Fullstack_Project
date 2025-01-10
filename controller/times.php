<?php
//
//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
//    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
//) {
//    $action = $_GET['action'] ?? '';
//
//    switch($action) {
//        case 'getTimes':
//            if (!$_SESSION['is_admin']) {
//                http_response_code(403);
//                exit(json_encode(['error' => 'Unauthorized']));
//            }
//            $times = getAllTimes($pdo);
//            header('Content-Type: application/json');
//            echo json_encode($times);
//            break;
//
//        case 'deleteTime':
//            if (!$_SESSION['is_admin']) {
//                http_response_code(403);
//                exit(json_encode(['error' => 'Unauthorized']));
//            }
//            $data = json_decode(file_get_contents('php://input'), true);
//            $result = deleteTime($pdo, $data['timeId']);
//            header('Content-Type: application/json');
//            echo json_encode(['success' => $result]);
//            break;
//    }
//    exit;
//}



if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?component=login");
    exit();
}

if ($_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}
