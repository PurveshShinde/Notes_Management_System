<?php
// Check if we are running locally or on Render
$isLocal = false; // Keep false for Render

if ($isLocal) {
    // Local XAMPP settings
    $host = 'localhost';
    $port = '3306';
    $username = 'root';
    $password = '';
    $dbname = 'notes';
} else {
    // Secure Cloud settings using Render Environment Variables
    $host = $_SERVER['DB_HOST'] ?? getenv('DB_HOST');
    $port = $_SERVER['DB_PORT'] ?? getenv('DB_PORT') ?: '4000';
    $username = $_SERVER['DB_USER'] ?? getenv('DB_USER');
    $password = $_SERVER['DB_PASS'] ?? getenv('DB_PASS');
    $dbname = $_SERVER['DB_NAME'] ?? getenv('DB_NAME');
}

try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    exit("Connection Error: " . $e->getMessage());
}
?>
