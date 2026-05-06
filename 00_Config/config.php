<?php
// 00_Config/config.php

// $host   = "localhost";
// $dbname = "medifind_rocketlabs";
// $user   = "root";
// $pass   = "";

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//     $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
// } catch (PDOException $e) {
//     die(json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]));
// }


// 00_Config/config.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
chdir(__DIR__ . '/..');


$host   = getenv('MYSQLHOST')     ?: ($_ENV['MYSQLHOST']     ?? false);
$dbname = getenv('MYSQLDATABASE') ?: ($_ENV['MYSQLDATABASE'] ?? false);
$user   = getenv('MYSQLUSER')     ?: ($_ENV['MYSQLUSER']     ?? false);
$pass   = getenv('MYSQLPASSWORD') ?: ($_ENV['MYSQLPASSWORD'] ?? false);
$port   = getenv('MYSQLPORT')     ?: ($_ENV['MYSQLPORT']     ?? false);

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    $pdo = new PDO($dsn, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die(json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage(),
        'host' => $host,
        'db' => $dbname
    ]));
}

?>
