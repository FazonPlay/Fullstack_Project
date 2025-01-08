<?php
include 'includes/database.php';

function login(PDO $pdo, string $username, string $password)
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM users WHERE username = :username";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':username', $username, PDO::PARAM_STR);
    try {
        $prep->execute();
        return $prep->fetch(PDO::FETCH_ASSOC); // Make sure to fetch as associative array
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

//}
//
//function logout()
//{
//    session_destroy();
//    header('Location: index.php');
//    exit();
//}
//
//function is_logged()
//{
//    return isset($_SESSION['user_id']);
//}
//
//function is_admin()
//{
//    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
//}

?>