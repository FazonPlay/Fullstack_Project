<?php


function create_user(
    PDO    $pdo,
    string $username,
    string $password,
): ?int
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $prep = $pdo->prepare($query);
    try {
        $prep->bindValue(':username', $username, PDO::PARAM_STR);
        $prep->bindValue(':password', $password, PDO::PARAM_STR);
        $prep->execute();

        return (int)$pdo->lastInsertId();

    } catch (PDOException $e) {
        error_log("Create user error: " . $e->getMessage());
        return null;
    }
}

