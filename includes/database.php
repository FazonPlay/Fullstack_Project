<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=memory_game','root','');
} catch (Exception $e) {
    $errors[] = "Error, can't connect to the database {$e->getMessage()}";
}
