<?php
//Set database account details
$host = 'localhost';
$dbname = 'traininglog';
$username = 'root';
$password = '';

//Connect to database using PDO
try{
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Log</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body style = background-color:White>
    <h2 class="centerTop">Training Log</h2>
    <form method="post" action="process_form.php">
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br>

    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required><br>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" required><br>

    <label for="country">Country/Region/Province:</label>
    <input type="text" id="country" name="country" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="phone">Mobile Phone:</label>
    <input type="tel" id="phone" name="phone" required><br>

    <label for="other_contact">Other Contact Info:</label>
    <input type="text" id="other_contact" name="other_contact"><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>

    <label for="notes">Notes:</label>
    <textarea id="notes" name="notes"></textarea><br>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="in_progress">In Progress</option>
    </select><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
