<?php
/**
 * @var PDO $pdo
 */

require "model/dashboard.php";

$topTen = getTopTen($pdo);




if (isset($_SESSION['auth'])) {
    $gPlayed = getGamesPlayed($pdo, $_SESSION['user_id']);
    $bestTime = getBestTime($pdo, $_SESSION['user_id']);
    $lastPlayed = getLastPlayed($pdo, $_SESSION['user_id']);
}

require "view/dashboard.php";


