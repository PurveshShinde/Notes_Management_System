<?php
// DB credentials with fallback for local development
$host = getenv('DB_HOST') ?: ($_SERVER['DB_HOST'] ?? 'localhost');
$port = getenv('DB_PORT') ?: ($_SERVER['DB_PORT'] ?? '3306');
$username = getenv('DB_USER') ?: ($_SERVER['DB_USER'] ?? 'root');
$password = getenv('DB_PASS') ?: ($_SERVER['DB_PASS'] ?? '');
$dbname = getenv('DB_NAME') ?: ($_SERVER['DB_NAME'] ?? 'notes');

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
);

// Enable SSL for secure connections (e.g., TiDB Serverless) if the CA bundle exists (true in Debian/Ubuntu Docker images)
if (file_exists('/etc/ssl/certs/ca-certificates.crt')) {
    $options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt';
}

try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, $options);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    exit("Connection Error: " . $e->getMessage());
}
?>
