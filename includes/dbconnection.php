<?php
$isLocal = false; 

if ($isLocal) {
    $host = 'localhost';
    $port = '3306';
    $username = 'root';
    $password = '';
    $dbname = 'notes';
} else {
    // Try both methods to catch the environment variables
    $host = getenv('DB_HOST') ?: ($_SERVER['DB_HOST'] ?? '');
    $port = getenv('DB_PORT') ?: ($_SERVER['DB_PORT'] ?? '4000');
    $username = getenv('DB_USER') ?: ($_SERVER['DB_USER'] ?? '');
    $password = getenv('DB_PASS') ?: ($_SERVER['DB_PASS'] ?? '');
    $dbname = getenv('DB_NAME') ?: ($_SERVER['DB_NAME'] ?? 'notes');
}

// TEMPORARY DEBUG: Let's see what values Render is actually passing
echo "DEBUG HOST: [" . $host . "]<br>";
echo "DEBUG USER: [" . $username . "]<br>";
exit; 

try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} 
catch (PDOException $e) {
    exit("Connection Error: " . $e->getMessage());
}
?>
