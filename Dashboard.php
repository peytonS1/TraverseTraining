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
    <title>TRAVERSE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body style = background-color:White>
    <h2 class="centerTop">TRAVERSE</h2>
    <nav class = "leftCenter">
        <a href = "Certification.php" class = "btn btn-info" role = "button">Certification</a>
        <a href = "TrainingLog.php" class = "btn btn-info" role = "button">Training Log</a>
        <a href = "Bidding.php" class = "btn btn-info" role = "button">Bidding</a>

    </nav> 
    
</body>
</html>
