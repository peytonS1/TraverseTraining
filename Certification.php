
<?php
// Include the database connection
require 'db.php';

$showAlert = false; 
$showError = false;
$exists = false;

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"></script>
</head>
<body style = background-color:White>
    <h2 class="centerTop">Certification</h2>
    <form method="post" action="process_form.php">

    <h3>Mobile Platform</h3>
    <form method="post" action="process_form.php">
        <table id="mobile_platform_table">
            <thead>
                <tr>
                    <th>Part Model</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_model[]">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Canova Platform 001">Canova Platform 001</option>
                            <option value="Canova Platform 002">Canova Platform 002</option>
                            <option value="Canova Platform 003">Canova Platform 003</option>
                            <option value="Canova Platform 004">Canova Platform 004</option>
                            <option value="Canova Platform 005">Canova Platform 005</option>
                        </select>
                    </td>
                    <td>
                        <input type="range" name="progress[]" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                        <span class="progress_value">50%</span>
                    </td>
                    <td><input type="text" name="cert_status[]" value="In Progress"></td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
    </form>
    <button type="button" id="add_row1">Add Row</button>

    <!-- Robotic Arm Table -->
    <h3>Robotic Arm</h3>
    <form method="post" action="process_form.php">
        <table id="robotic_arm_table">
            <thead>
                <tr>
                    <th>Part Model</th>
                    <th>End Effector</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_modelArm[]" onchange="populateEndEffectorDropdown(this)">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Canova Arm 001">Canova Arm 001</option>
                            <option value="Canova Arm 002">Canova Arm 002</option>
                            <option value="Canova Arm 003">Canova Arm 003</option>
                            <option value="Canova Arm 004">Canova Arm 004</option>
                            <option value="Canova Arm 005">Canova Arm 005</option>
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
                    <td><input type="text" name="cert_status[]" value="In Progress"></td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
    </form>
    <button type="button" id="add_row2">Add Row</button>

    <!-- VR Table -->
    <h3>VR</h3>
    <form method="post" action="process_form.php">
        <table id="vr_table">
            <thead>
                <tr>
                    <th>Part Model</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_modelvr[]">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Canova VR 001">Canova VR 001</option>
                            <option value="Canova VR 002">Canova VR 002</option>
                            <option value="Canova VR 003">Canova VR 003</option>
                            <option value="Canova VR 004">Canova VR 004</option>
                            <option value="Canova VR 005">Canova VR 005</option>
                        </select>
                    </td>
                    <td>
                        <input type="range" name="progress[]" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                        <span class="progress_value">50%</span>
                    </td>
                    <td><input type="text" name="cert_status[]" value="In Progress"></td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
    </form>
    <button type="button" id="add_row3">Add Row</button>
    <button type="submit" class="submit">Submit</button>
</form>

<script>
    // Event listener for Add Row button click to dynamically add rows
    document.getElementById("add_row1").addEventListener("click", function() {
        var table = document.getElementById("mobile_platform_table").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);

        cell1.innerHTML = `
            <select name="part_model[]">
            <!-- Options will be dynamically populated based on selection -->
            <option value="Canova Platform 001">Canova Platform 001</option>
            <option value="Canova Platform 002">Canova Platform 002</option>
            <option value="Canova Platform 003">Canova Platform 003</option>
            <option value="Canova Platform 004">Canova Platform 004</option>
            <option value="Canova Platform 005">Canova Platform 005</option>
            </select>`;
        cell2.innerHTML = '<input type="range" name="progress[]" min="0" max="100" value="0" oninput="updateProgressValue(this)"><span class="progress_value">0%</span>';
        cell3.innerHTML = '<input type="text" name="cert_status[]" value="">';
    });

    // Event listener for Add Row button click to dynamically add rows
    document.getElementById("add_row2").addEventListener("click", function() {
        var table = document.getElementById("robotic_arm_table").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell3 = newRow.insertCell(3);

        cell1.innerHTML = `
            <select name="part_modelArm[]">
            <option value="Canova Arm 001">Canova Arm 001</option>
            <option value="Canova Arm 002">Canova Arm 002</option>
            <option value="Canova Arm 003">Canova Arm 003</option>
            <option value="Canova Arm 004">Canova Arm 004</option>
            <option value="Canova Arm 005">Canova Arm 005</option>
            </select>`;
        cell2.innerHTML = '<select name="end_effector[]"></select>';
        cell3.innerHTML = '<input type="range" name="progress[]" min="0" max="100" value="0" oninput="updateProgressValue(this)"><span class="progress_value">0%</span>';
        cell4.innerHTML = '<input type="text" name="cert_status[]" value="">';
    });

        // Event listener for Add Row button click to dynamically add rows
        document.getElementById("add_row3").addEventListener("click", function() {
        var table = document.getElementById("vr_table").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);


        cell1.innerHTML = `
            <select name="part_modelvr[]">
            <option value="Canova VR 001">Canova VR 001</option>
            <option value="Canova VR 002">Canova VR 002</option>
            <option value="Canova VR 003">Canova VR 003</option>
            <option value="Canova VR 004">Canova VR 004</option>
            <option value="Canova VR 005">Canova VR 005</option>
            </select>`;
        cell2.innerHTML = '<input type="range" name="progress[]" min="0" max="100" value="0" oninput="updateProgressValue(this)"><span class="progress_value">0%</span>';
        cell3.innerHTML = '<input type="text" name="cert_status[]" value="">';
    });

    // Bind the updateProgressValue function to existing progress sliders
    var existingSliders = document.querySelectorAll('input[type="range"]');
    existingSliders.forEach(function(slider) {updateProgressValue(slider);
    });

        // Function to update the progress value display
        function updateProgressValue(slider) {
        var progressValueSpan = slider.parentNode.querySelector('.progress_value');
        progressValueSpan.innerHTML = slider.value + '%';
    }
    // Function to populate the End Effector dropdown based on selected Part Model
    function populateEndEffectorDropdown(select) {
        var endEffectorDropdown = select.parentNode.nextElementSibling.querySelector('select[name=end_effector[]]');
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
    }
</script>
</body>
</html>