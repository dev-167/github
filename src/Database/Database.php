<?php
// Datenbankverbindung
//$pdo = new PDO('mysql:host=localhost;dbname=emplyee_db','root','mysql');

$dsn = 'mysql:host=localhost;dbname=emplyee_db;charset=utf8mb4';
$username = 'root';
$password = 'mysql';


// Debugging
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>