<?php


function get_top_five(PDO $pdo, int $user_id): array | string {
    $query = "SELECT duration FROM game_times WHERE user_id = :user_id ORDER BY duration DESC LIMIT 5";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        error_log("Error getting top five times: " . $e->getMessage());
        return "Error getting top five times";
    }
    $res = $prep->fetch();
    $prep->closeCursor();
    return $res;
}

//    $query = "SELECT duration FROM game_times ORDER BY duration DESC LIMIT 5";
//    $result = mysqli_query($conn, $query);
//    $times = [];
//    while ($row = mysqli_fetch_assoc($result)) {
//        $times[] = $row;
//    }
//    return $times;

function get_times(PDO $pdo): array | string {
    $query = "        SELECT 
            gt.id AS game_id, 
            u.username, 
            gt.duration, 
            gt.created_at 
        FROM 
            game_times AS gt 
        JOIN 
            users AS u 
        ON 
            gt.user_id = u.id 
        ORDER BY 
            gt.duration ASC ";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        error_log("Error getting times: " . $e->getMessage());
        return "Error getting times";
    }
    $res = $prep->fetchAll();
    $prep->closeCursor();
    return $res;
}

function delete_time(PDO $pdo, int $time_id): bool {
    $query = "DELETE FROM game_times WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':time_id', $time_id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        error_log("Error deleting time: " . $e->getMessage());
        return false;
    }
    return true;
}




