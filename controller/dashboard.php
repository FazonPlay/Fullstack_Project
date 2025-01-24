<?php

require "model/dashboard.php";

$topTen = getTopTen($pdo);

require "view/dashboard.php";


