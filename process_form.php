<?php
require 'db.php';
// Retrieve form data
$user_profile_id = isset($_POST['user_profile_id']) ? $_POST['user_profile_id'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
$partModel = isset($_POST['part_model']) ? $_POST['part_model'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$progress = isset($_POST['progress']) ? $_POST['progress'] : '';
$certStatus = isset($_POST['cert_status']) ? $_POST['cert_status'] : '';
$dateadded = isset($_POST['dateadded']) ? $_POST['dateadded'] : '';
$expirationdate = isset($_POST['expirationdate']) ? $_POST['expirationdate'] : '';

// Sanitize data (e.g., using mysqli_real_escape_string or prepared statements)

// Connect to the database (replace placeholders with actual database credentials)
$host = 'localhost';
$dbname = 'traininglog';
$username = 'root';
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert or update data into the database
$sql = "INSERT INTO certification (userprofileid, robotclass, partmodel, progress, certstatus, description, dateadded, expirationdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("ssssssss", $user_profile_id, $class, $partModel, $description, $progress, $certStatus, $dateadded, $expirationdate);
$result = $stmt->execute();

if (!$result) {
    die("Execution failed: (" . $stmt->errno . ") " . $stmt->error);
}

// Close the database connection
$stmt->close();
$conn->close();

// Redirect the user to a success page
header("Location: TrainingLog.php");
exit();
?>
