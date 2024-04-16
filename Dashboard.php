<?php
// Include your database connection
require 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user selection is set and not empty
    if (isset($_POST['user_selection']) && !empty($_POST['user_selection'])) {
        // Sanitize the input to prevent SQL injection
        $user_selection = mysqli_real_escape_string($connection, $_POST['user_selection']);
        
        // Store the user selection in a session variable
        $_SESSION['user_selection'] = $user_selection;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAVERSE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body style="background-color:White">
    <h2 class="centerTop">For Testing Purposes, Select User:</h2>
    <nav class="leftCenter">
        <form method="post">
            <!-- User selection dropdown -->
            <select name="user_selection" class="btn btn-info" role="button">
                <option value="" selected disabled>Select an option</option>
                <?php
                // Query to fetch user options from database
                $query = "SELECT * FROM your_table_name";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['option_value'] . "'>" . $row['option_name'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Save Selection">
        </form>
        <a href="Certification.php" class="btn btn-info" role="button">Certification</a>
        <a href="TrainingLog.php" class="btn btn-info" role="button">Training Log</a>
        <a href="Bidding.php" class="btn btn-info" role="button">Bidding</a>
    </nav> 
</body>
</html>