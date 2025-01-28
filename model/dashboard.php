<?php

function getTopTen(PDO $pdo): array
{
    $query = "SELECT game_times.duration, game_times.created_at, users.username FROM game_times JOIN users ON game_times.user_id = users.id ORDER BY `game_times`.`duration` DESC LIMIT 10 ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

//function getTimePlayedByUser(PDO $pdo, int $userId): array
//{
//    $query = "SELECT duration, created_at FROM game_times WHERE user_id = :user_id ORDER BY duration DESC";
//    $stmt = $pdo->prepare($query);
//    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
//    $stmt->execute();
//    return $stmt->fetchAll();
//}