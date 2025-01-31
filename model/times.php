<?php
function getTimes(PDO $pdo, int $page = 1, int $itemsPerPage): array | string
{
    $offset = ($page - 1) * $itemsPerPage;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
       SELECT gt.id AS game_id,  u.username, gt.duration, gt.created_at 
        FROM game_times AS gt 
        JOIN  users AS u 
        ON gt.user_id = u.id 
        ORDER BY gt.duration ASC ";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $prep->bindValue(':offset', $offset, PDO::PARAM_INT);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "Error: " . $e->getCode() . " - " . $e->getMessage();
    }

    $users = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    $query = "SELECT COUNT(*) AS total FROM users";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "Error: " . $e->getCode() . " - " . $e->getMessage();
    }

    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return ['users' => $users, 'total' => $count['total']];
}

function deleteTime (PDO $pdo, int $id): bool | string {
    $query = "DELETE FROM game_times WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        error_log("Error deleting time: " . $e->getMessage());
        return "Error deleting time";
    }
    $prep->closeCursor();
    return true;
}



