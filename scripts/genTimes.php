<?php
/**
 * @var PDO $pdo
 */
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Adjust the path to your .env file
$dotenv->load();
require '../includes/database.php';

$faker = Faker\Factory::create('en_US');

$userIds = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);

if (empty($userIds)) {
    echo("No users found in the database. Please populate the users table first.");
}

for ($i = 0; $i <= 100; $i++) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO game_times (duration, created_at, user_id) VALUES (:duration, :created_at, :user_id)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':duration', $faker->numberBetween(1, 300), PDO::PARAM_INT);
    $prep->bindValue(':created_at', $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'));
    $prep->bindValue(':user_id', $faker->randomElement($userIds), PDO::PARAM_INT);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
    }
    $prep->closeCursor();
}





