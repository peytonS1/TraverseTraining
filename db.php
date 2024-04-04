<?php
// Database credentials
$host = 'localhost';
$dbname = 'traininglog';
$username = 'root';
$password = ''; 

// DSN (Data Source Name) specifies the host
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create a PDO instance (connect to the database)
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception to catch any errors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment below line to disable emulation of prepared statements, using real prepared statements instead
    // $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    // Connection success message for debugging (optional)
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // If there is an error in the connection, catch it and display the error message
    die("Connection failed: " . $e->getMessage());
}
?>
