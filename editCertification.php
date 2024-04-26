<?php
// Include the database connection
require 'db.php';

// Check if the 'certid' and 'user_id' are provided as parameters
if(isset($_GET['cert_id']) && isset($_GET['user_id'])) {
    $cert_id = $_GET['cert_id'];
    $user_id = $_GET['user_id'];

    // Fetch certification information from the database based on the 'certid' and 'user_id'
    $query = "SELECT * FROM certification WHERE certid = $cert_id AND userprofileid = $user_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $certification = mysqli_fetch_assoc($result);
        // Extract certification details
        $robotclass = $certification['robotclass'];
        $progress = $certification['progress'];
        $description = $certification['description'];
        $certstatus = $certification['certstatus'];
        $dateadded = $certification['dateadded'];
        $expirationdate = $certification['expirationdate'];
    } else {
        // If no certification found for the user with the specified 'certid', redirect back to TrainingLog.php or display an error message
        header("Location: TrainingLog.php");
        exit;
    }
} 


// Check if the admin user is logged in
if(!isset($_SESSION['selected_user'])) {
    // If not logged in, redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}

// Handle form submission to update certification information
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $progress = mysqli_real_escape_string($conn, $_POST['progress']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $certstatus = mysqli_real_escape_string($conn, $_POST['certstatus']);
    $dateadded = mysqli_real_escape_string($conn, $_POST['dateadded']);
    $expirationdate = mysqli_real_escape_string($conn, $_POST['expirationdate']);

    // Update the database with the edited certification information
    $update_query = "UPDATE certification SET progress = '$progress', description = '$description', certstatus = '$certstatus', dateadded = '$dateadded', expirationdate = '$expirationdate' WHERE certid = $cert_id";

    if(mysqli_query($conn, $update_query)) {
        // If update successful, redirect back to TrainingLog.php or display a success message
        header("Location: TrainingLog.php");
        exit;
    } else {
        // If update fails, display an error message
        $error_message = "Failed to update certification information.";
    }
}
?>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Certification</title>
</head>
<body>
    <h2>Edit Certification</h2>
    <!-- Display error message if any -->
    <?php if(isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <!-- Form to edit certification details -->
    <form method="post">
        <!-- Input fields to edit certification details -->
        <label for="robotclass">Robot Class:</label><br>
        <input type="text" id="robotclass" name="robotclass" value="<?php echo $robotclass; ?>"><br><br>

        <label for="progress">Progress %:</label><br>
        <input type="text" id="progress" name="progress" value="<?php echo $progress; ?>"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br><br>

        <label for="certstatus">Certification Status:</label><br>
        <input type="text" id="certstatus" name="certstatus" value="<?php echo $certstatus; ?>"><br><br>

        <label for="dateadded">Date added: (year/month/day)</label><br>
        <input type="text" id="dateadded" name="dateadded" value="<?php echo $dateadded; ?>"><br><br>

        <label for="expirationdate">Expiration Date: (year/month/day)</label><br>
        <input type="text" id="expirationdate" name="expirationdate" value="<?php echo $expirationdate; ?>"><br><br>

        <input type="submit" value="Save">
        <input type="submit" value="Cancel" onclick="window.location.href='TrainingLog.php'">
    </form>
</body>
</html>
