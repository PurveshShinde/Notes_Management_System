<?php
// Check if we are running locally or on Render
$isLocal = false; // Change to true only when testing on your own PC

if ($isLocal) {
    // Local XAMPP settings
    $host = 'localhost';
    $port = '3306';
    $username = 'root';
    $password = '';
    $dbname = 'notes';
} else {
    // Secure Cloud settings (reads from Render Environment Variables)
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $dbname = getenv('DB_NAME');
}

try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
