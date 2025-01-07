<?php
session_start();
include 'includes/database.php';

function login(PDO $pdo, string $username, string $password)
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT *  FROM users WHERE (username = :username)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':username', $username, PDO::PARAM_STR);
    $prep->bindValue(':password', $password, PDO::PARAM_STR);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        $response = " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $res = $prep->fetch();
    $prep->closeCursor();
    return $res;
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