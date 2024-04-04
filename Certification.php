
<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "traininglog";
  

$showAlert = false; 
$showError = false; 
$exists=false;

    //Connect to database using PDO
    try{
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare SQL statement to insert data into the certification table
        $sql = "INSERT INTO certification (robotclass, partmodel, endefector, progress, certstatus) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        // Bind parameters with form values
        $stmt->bindParam(1, $_POST['robot_class']);
        $stmt->bindParam(2, $_POST['part_model']);
        $stmt->bindParam(3, $_POST['end_effector']);
        $stmt->bindParam(4, $_POST['progress']);
        $stmt->bindParam(5, $_POST['cert_status']);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Data uploaded to the database successfully!";
        } else {
            echo "Error uploading data to the database.";
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
                <th>Robot Class</th>
                <th>Part Model</th>
                <th>End Effector</th>
                <th>Progress</th>
                <th>Certification Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="robot_class[]" onchange="populatePartModelDropdown(this)">
                        <option value="Mobile Platform">Mobile Platform</option>
                        <option value="Robotic Arm">Robotic Arm</option>
                        <option value="VR">VR</option>
                    </select>
                </td>
                <td>
                    <select name="part_model[]">
                        <!-- Options will be dynamically populated based on selection -->
                    </select>
                </td>
                <td>
                    <select name="end_effector[]">
                        <!-- Options will be dynamically populated based on selection -->
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
    <button type="submit" class="submit">Submit</button>
</form>

<script>
    // Function to update the progress value display
    function updateProgressValue(slider) {
        var progressValueSpan = slider.parentNode.querySelector('.progress_value');
        progressValueSpan.innerHTML = slider.value + '%';
    }

    // Function to populate the Part Model dropdown based on Robot Class selection
    function populatePartModelDropdown(select) {
        var partModelDropdown = select.parentNode.nextElementSibling.querySelector('select[name="part_model[]"]');
        partModelDropdown.innerHTML = ''; // Clear existing options
        var robotClass = select.value;
        var partModelOptions = [];
        switch (robotClass) {
            case 'Mobile Platform':
                partModelOptions = ['Canova Platform 001', 'Canova Platform 002', 'Canova Platform 003', 'Canova Platform 004', 'Canova Platform 005'];
                break;
            case 'Robotic Arm':
                partModelOptions = ['Canova Arm 001', 'Canova Arm 002', 'Canova Arm 003', 'Canova Arm 004', 'Canova Arm 005'];
                break;
            case 'VR':
                partModelOptions = ['Canova VR 001', 'Canova VR 002', 'Canova VR 003', 'Canova VR 004', 'Canova VR 005'];
                break;
            default:
                partModelOptions = [];
                break;
        }
        partModelOptions.forEach(function(option) {
            var optionElem = document.createElement('option');
            optionElem.value = option;
            optionElem.textContent = option;
            partModelDropdown.appendChild(optionElem);
        });
    }

    function populateEndEffectorDropdown(select) {
        var endEffectorDropdown = select.parentNode.nextElementSibling.querySelector('select[name="end_effector[]"]');
        endEffectorDropdown.innerHTML = ''; // Clear existing options
        var partModel = select.value;
        var endEffectorOptions = [];
        switch (partModel) {
            case 'Canova Arm 001':
                endEffectorOptions = ['Arm End Effector 001', 'Arm End Effector 002', 'Arm End Effector 003', 'Arm End Effector 004', 'Arm End Effector 005'];
                break;
            case 'Canova Arm 002':
                endEffectorOptions = ['Arm End Effector 001', 'Arm End Effector 002', 'Arm End Effector 003', 'Arm End Effector 004', 'Arm End Effector 005'];
                break;
            case 'Canova Arm 003':
                endEffectorOptions = ['Arm End Effector 001', 'Arm End Effector 002', 'Arm End Effector 003', 'Arm End Effector 004', 'Arm End Effector 005'];
                break;
            case 'Canova Arm 004':
                endEffectorOptions = ['Arm End Effector 001', 'Arm End Effector 002', 'Arm End Effector 003', 'Arm End Effector 004', 'Arm End Effector 005'];
                break;
            case 'Canova Arm 005':
                endEffectorOptions = ['Arm End Effector 001', 'Arm End Effector 002', 'Arm End Effector 003', 'Arm End Effector 004', 'Arm End Effector 005'];
                break;
            // Add cases for other Part Models as needed
            default:
                endEffectorOptions = [];
                break;
        }
        endEffectorOptions.forEach(function(option) {
            var optionElem = document.createElement('option');
            optionElem.value = option;
            optionElem.textContent = option;
            endEffectorDropdown.appendChild(optionElem);
        });
    }

    // Event listener for Add Row button click to dynamically add rows
    document.getElementById("add_row").addEventListener("click", function() {
        var table = document.getElementById("robot_table").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        cell1.innerHTML = `
            <select name="robot_class[]" onchange="populatePartModelDropdown(this)">
                <option value="Mobile Platform">Mobile Platform</option>
                <option value="Robotic Arm">Robotic Arm</option>
                <option value="VR">VR</option>
            </select>`;
        cell2.innerHTML = '<select name="part_model[]"></select>';
        cell3.innerHTML = '<select name="end_effector[]"></select>';
        cell4.innerHTML = '<input type="range" name="progress[]" min="0" max="100" value="0" oninput="updateProgressValue(this)"><span class="progress_value">0%</span>';
        cell5.innerHTML = '<input type="text" name="cert_status[]" value="">';
    });

    // Bind the updateProgressValue function to existing progress sliders
    var existingSliders = document.querySelectorAll('input[type="range"]');
    existingSliders.forEach(function(slider) {
        updateProgressValue(slider);
    });
</script>
</body>
</html>
