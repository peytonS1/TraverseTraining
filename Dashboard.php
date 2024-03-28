<?php
//Set database account details
$host = 'localhost';
$dbname = 'tcd';
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
        #frm{
            margin-top: auto;
            font: bold;
        }

        .centerTop{
            font-size: 50px;
            left: 41%;
        }

        .leftCenter{
            margin-top: auto;
            left: 36%;
        }
    </style>
</head>
<body style = background-color:White>
    <h2 class="centerTop">TRAVERSE</h2>
    <nav class = "leftCenter">
        <a href = "Certification.php" class = "btn btn-info" role = "button">Certification</a>
        <a href = "TrainingLog.php" class = "btn btn-info" role = "button">Training Log</a>
        <a href = "Bidding.php" class = "btn btn-info" role = "button">Bidding</a>

    </nav> 
     <div id = "frm">
        <h1>Login</h1>
        <form name="f1" action = "login.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> Email: </label>  
                <input type = "text" id ="email" name  = "email" />  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="password" name  = "password" />  
            </p>  
            <p>     
                <input type =  "submit" id = "btn" value = "Login" />  
            </p>  
        </form>  
    </div>
    <script>  
            function validation()  
            {  
                var id=document.f1.email.value;  
                var ps=document.f1.password.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("Email and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("Email is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>
    
    <form method="POST" action="Register.php">
        <button name="subject" type="submit">Register New User</button>
    </form>

</body>
</html>
