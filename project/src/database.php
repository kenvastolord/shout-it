<?php

$dbHost = getenv('DB_HOST');
$dbDatabase = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPass = getenv('DB_PASSWORD');

$dns = "mysql:host=$dbHost;dbname=$dbDatabase;charset=utf8mb4";

try {
    $pdo = new PDO($dns, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Connection failed: ' . $e->getMessage());
    echo 'Connection failed ' . $e->getMessage();
}
