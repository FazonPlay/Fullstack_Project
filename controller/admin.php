<?php
include 'model/admin.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Access denied";
    exit();
}


require "view/admin.php";

?>
