<?php
///**
// * @var PDO $pdo
// */
//require '../vendor/autoload.php';
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Adjust the path to your .env file
//$dotenv->load();
//require '../includes/database.php';
//
//
//
//
//$faker = Faker\Factory::create('en_US');
//
//for ($i = 0; $i <= 100; $i++) {
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
//    $prep = $pdo->prepare($query);
//    $prep->bindValue(':password', password_hash($faker->password, PASSWORD_DEFAULT));
//    $prep->bindValue(':username', $faker->userName);
//    try {
//        $prep->execute();
//    } catch (PDOException $e) {
//        echo "Error: " . $e->getCode() . ' : ' . $e->getMessage();
//    }
//    $prep->closeCursor();
//}

/**
 * @var PDO $pdo
 */
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Adjust the path to your .env file
$dotenv->load();
require '../includes/database.php';

function insertAdminUser(PDO $pdo): void
{
    $query = "SELECT id FROM users WHERE id = 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $query = "INSERT INTO users (id, username, password, is_admin) VALUES (:id, :username, :password, :is_admin)";
    $stmt = $pdo->prepare($query);

    $username = 'admin';
    $password = password_hash('admin', PASSWORD_DEFAULT);
    $isAdmin = 1;
    $id = 1;

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':is_admin', $isAdmin, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "Admin user created successfully.\n";
    } catch (PDOException $e) {
        echo "Error: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
    }
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

insertAdminUser($pdo);

$faker = Faker\Factory::create('en_US');

for ($i = 0; $i <= 100; $i++) {
    $query = "INSERT INTO users (username, password, is_admin) VALUES (:username, :password, :is_admin)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':password', password_hash($faker->password, PASSWORD_DEFAULT));
    $prep->bindValue(':username', $faker->userName);
    $prep->bindValue(':is_admin', 0, PDO::PARAM_INT); // Regular users are not admins

    try {
        $prep->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
    }
    $prep->closeCursor();
}
