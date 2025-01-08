// model/times.php
<?php

function getAllTimes(PDO $pdo) {
    $stmt = $pdo->query("SELECT * FROM game_times ORDER BY duration ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteTime(PDO $pdo, int $timeId) {
    $stmt = $pdo->prepare("DELETE FROM game_times WHERE id = ?");
    return $stmt->execute([$timeId]);
}
