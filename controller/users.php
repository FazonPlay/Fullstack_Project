<?php
require "model/users.php";
require "model/user.php";
$is_admin = $_SESSION["is_admin"] === true;

$users = getUsers($pdo);







require "view/users.php";