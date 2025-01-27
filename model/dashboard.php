<?php

function getTopTen(PDO $pdo): array
{
    $query = "SELECT game_times.duration, game_times.created_at, users.username FROM game_times JOIN users ON game_times.user_id = users.id ORDER BY `game_times`.`duration` DESC LIMIT 10 ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function playedGames(PDO $pdo): array
{
    $query = "SELECT u.username, COUNT(*) AS games_played FROM game_times gt JOIN users u ON u.id = gt.user_id GROUP BY gt.user_id; ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch();
}