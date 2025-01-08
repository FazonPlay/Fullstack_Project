<?php


//function createUser($db, $username, $password) {
//    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
//    $stmt->bindParam(':username', $username);
//    $stmt->bindParam(':password', $password);
//    $stmt->execute();
//}
function getGameTimes($db) {
    $stmt = $db->prepare("SELECT * FROM games ORDER BY time ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
