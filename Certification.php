
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body style = background-color:White>
    <h2 class="centerTop">Certification</h2>
    <form method="post" action="process_form.php">
        <table id="robot_table">
            <thead>
                <tr>
                    <th>Robot Part</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="robot_class[]">
                            <option value="Mobile Platform">Mobile Platform</option>
                            <option value="Robotic Arm">Robotic Arm</option>
                            <option value="VR">VR</option>
                            <option value="End Effector">End Effector</option>
                        </select>
                    </td>
                    <td>
                        <input type="range" name="progress[]" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                        <span class="progress_value">50%</span>
                    </td>
                    <td><input type="text" name="cert_status[]" value="Certified"></td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
        <button type="button" id="add_row">Add Row</button>
        <input type="submit" value="Submit">
    </form>

    <script>
        function updateProgressValue(slider) {
            var progressValueSpan = slider.parentNode.querySelector('.progress_value');
            progressValueSpan.innerHTML = slider.value + '%';
        }

        document.getElementById("add_row").addEventListener("click", function() {
            var table = document.getElementById("robot_table").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            cell1.innerHTML = `
                <select name="robot_class[]">
                    <option value="Mobile Platform">Mobile Platform</option>
                    <option value="Robotic Arm">Robotic Arm</option>
                    <option value="VR">VR</option>
                    <option value="End Effector">End Effector</option>
                </select>`;
            cell2.innerHTML = '<input type="range" name="progress[]" min="0" max="100" value="0" oninput="updateProgressValue(this)"><span class="progress_value">0%</span>';
            cell3.innerHTML = '<input type="text" name="cert_status[]" value="">';
        });

        // Bind the updateProgressValue function to existing progress sliders
        var existingSliders = document.querySelectorAll('input[type="range"]');
        existingSliders.forEach(function(slider) {
            updateProgressValue(slider);
        });
    </script>
</body>
</html>
