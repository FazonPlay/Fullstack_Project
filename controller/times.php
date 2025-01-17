<?php
$is_admin = $_SESSION["is_admin"] === true;

require "model/times.php";

$times = get_times($pdo);

require "view/times.php";


