<?php

//function delete_user($pdo, $id) {
//    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
//    $stmt->execute([$id]);
//}
//
//function update_user($pdo, $id, $username, $password) {
//    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
//    $stmt->execute([$username, $password, $id]);
//}
//

function getUsers(PDO $pdo, int $page = 1, int $itemsPerPage): array | string
{
    $offset = ($page - 1) * $itemsPerPage;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get users
    $query = "SELECT * FROM users LIMIT :limit OFFSET :offset";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $prep->bindValue(':offset', $offset, PDO::PARAM_INT);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "Erreur: " . $e->getCode() . " - " . $e->getMessage();
    }

    // Fetch users
    $users = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    // Get total count of users for pagination
    $query = "SELECT COUNT(*) AS total FROM users";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "Erreur: " . $e->getCode() . " - " . $e->getMessage();
    }

    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return ['users' => $users, 'total' => $count['total']];
}


?>

