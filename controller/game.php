<?php
/**
 * @var PDO $pdo
 */
require "model/game.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

    if (isset($_GET['action'])) {

        switch ($_GET['action']) {
            case 'saveTime':

                $userId = $_SESSION['user_id'] ?? null;
                $time = $_GET['time'] ?? null;


                if (!$time) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Invalid game time.']);
                    exit();
                }
                $res = saveTime($pdo, $time, $userId);

                if (is_bool($res)) {
                    http_response_code(200);
                    echo json_encode(['status' => 'success', 'message' => 'Game time saved successfully.']);
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Failed to save game time.']);
                }
                break;
        }
        exit();
    }
}
require "view/game.php";