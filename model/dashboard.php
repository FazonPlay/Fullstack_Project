<?php

function getTopTen(PDO $pdo): array
{
    $query = "SELECT game_times.duration, game_times.created_at, users.username FROM game_times JOIN users ON game_times.user_id = users.id ORDER BY `game_times`.`duration` ASC LIMIT 10 ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getGamesPlayed(PDO $pdo, int $user_id): int
{
    $query = "SELECT COUNT(*) FROM game_times WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    return (int) $stmt->fetchColumn();
}

function getBestTime(PDO $pdo, int $user_id): ?int
{
    $query = "SELECT MIN(duration) FROM game_times WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $result = $stmt->fetchColumn();
    return $result !== false ? (int) $result : null;
}

function getLastPlayed(PDO $pdo, int $user_id): ?string
{
    $query = "SELECT MAX(created_at) FROM game_times WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $result = $stmt->fetchColumn();
    return $result !== false ? $result : null;
}
