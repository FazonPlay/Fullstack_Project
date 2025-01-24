<?php

function getTopTen(PDO $pdo): array
{
    $query = "SELECT * FROM game_times ORDER BY duration DESC LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}