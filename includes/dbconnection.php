<?php
// Toggle switch: set to TRUE for your local computer, FALSE for Render/TiDB cloud
$isLocal = false; 

if ($isLocal) {
    // ==========================================
    // 1. LOCAL CONFIGURATION (XAMPP / Manual)
    // ==========================================
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','notes');

    try {
        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } 
    catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

} else {
    // ==========================================
    // 2. CLOUD CONFIGURATION (Render + TiDB)
    // ==========================================
    $host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com"; // Your TiDB Host
    $port = "4000";                                           // TiDB Port
    $username = "3FUL61XbsjZyFGC.root";                         // Your TiDB Username
    $password = "IDQ4S1dfWBgJIil0";                         // Your Generated Password
    $dbname = "notes";                                        // Database Name

    try {
        $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}
?>
