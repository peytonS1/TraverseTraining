<?php
require 'db.php'; // Include the database connection

// Initialize variables for feedback
$showAlert = false;
$showError = false;
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example for a generic form handling - adapt names and logic based on your actual form structure
    $formType = $_POST['form_type'] ?? ''; // Identifies which form is submitted, e.g., "training_log" or "certification"

    switch ($formType) {
        case 'training_log':
            // Assuming fields 'last_name', 'first_name', etc., are part of the form
            $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
            $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            // Repeat for all fields you have in your form

            // Additional validation can be added here for each field as needed

            try {
                $sql = "INSERT INTO training_logs (last_name, first_name) VALUES (?, ?)"; // Simplified, add your actual SQL and fields
                $stmt = $db->prepare($sql);
                $stmt->execute([$lastName, $firstName]);

                $showAlert = true;
            } catch (PDOException $e) {
                $showError = true;
                $errorMessage = "Error: " . $e->getMessage();
            }
            break;

        case 'certification':
            // Process certification form submission
            // Similar structure to 'training_log' case, adapted for the certification form fields
            break;

        // Add more cases for other forms as needed

        default:
            $showError = true;
            $errorMessage = "Unknown form submission";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <?php if ($showAlert): ?>
            <div class="alert alert-success" role="alert">
                Form submitted successfully!
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>
