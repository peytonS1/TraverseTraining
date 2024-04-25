<?php
session_start();
// Database credentials
$host = 'localhost';
$dbname = 'traininglog';
$username = 'root';
$password = ''; 
  
// Create a connection 
$conn = mysqli_connect($host, $username, $password, $dbname);

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
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the selected user is set and not empty
    if (isset($_POST['selected_user']) && !empty($_POST['selected_user'])) {
        // Sanitize the input to prevent SQL injection
        $selected_user = mysqli_real_escape_string($conn, $_POST['selected_user']);
        
        // Store the selected user in a session variable to use it in dashboard.php
        $_SESSION['selected_user'] = $selected_user;

                // Check if the selected user is the admin
                if ($selected_user == '00001') {
                    // Generate JavaScript code for a popup alert
                    echo "<script>alert('You are logged in as an admin.');</script>";
                } else {
                    // Display a success message for the selected user
                    echo "<p>User $selected_user selected successfully!</p>";
                }
    }
}
// Check if an admin is selected
$is_admin = isset($_SESSION['selected_user']) && $_SESSION['selected_user'] == '00001';
?>
