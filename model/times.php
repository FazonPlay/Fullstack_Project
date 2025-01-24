<?php
function get_times(PDO $pdo): array | string {
    $query = "
       SELECT gt.id AS game_id,  u.username, gt.duration, gt.created_at 
        FROM game_times AS gt 
        JOIN  users AS u 
        ON gt.user_id = u.id 
        ORDER BY gt.duration ASC ";
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


