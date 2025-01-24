<?php
/**
 * @var PDO $pdo
 */

function saveTime(PDO $pdo, float $time, int $userId): bool {
    $query = "INSERT INTO game_times (duration, user_id) VALUES (:duration, :user_id)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':duration', $time, PDO::PARAM_STR);
    $prep->bindValue(':user_id', $userId, PDO::PARAM_INT);

    try {
        $prep->execute();
        $prep->closeCursor();
        return true;
    } catch (PDOException $e) {
        error_log("Error saving time: " . $e->getMessage());
        return false;
    }
}

