<?php

require "model/times.php";

$times = get_times($pdo);

require "view/times.php";


