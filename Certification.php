
<?php
// Include the database connection
require 'db.php';

$showAlert = false; 
$showError = false;
$exists = false;


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['selected_user']) && !empty($_POST['selected_user'])) {
            // Get the selected user's profile ID
            $selected_user_profile_id = $_POST['selected_user'];
    
            // Prepare SQL statement to insert data into the certification table
            $sql = "INSERT INTO certification (user_profile_id, robotclass, partmodel, progress, certstatus, dateadded, expirationdate) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
    
            // Bind parameters with form values
            $stmt->bindParam(1, $selected_user_profile_id);
            $stmt->bindParam(2, $_POST['class']);
            $stmt->bindParam(3, $_POST['part_model']);
            $stmt->bindParam(4, $_POST['description']);
            $stmt->bindParam(5, $_POST['progress']);
            $stmt->bindParam(6, $_POST['cert_status']);
            $stmt->bindParam(7, $_POST['dateadded']);
            $stmt->bindParam(8, $_POST['expirationdate']);
        }
    }
?>

<!-- Search function for selecting a user -->
<form method="post">
        <select name="selected_user">
            <option value="" selected disabled>Select a user</option>
            <!-- Fetch users from the database and populate the dropdown -->
            <?php
            $query = "SELECT * FROM userprofile";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = ($row['userprofileid'] == $selected_user) ? 'selected' : '';
                echo "<option value='" . $row['userprofileid'] . "'>" . $row['lastname'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Select User">
</form>

<style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
</style>

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
<style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        h3 {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        select {
            width: 100%;
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        input[type="range"] {
            width: calc(100% - 50px);
            margin-right: 10px;
        }

        .progress_value {
            font-weight: bold;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
    <body style = background-color:White>
    <h2 class="centerTop">Certification</h2>
    <form method="post" action="process_form.php">

    <h3>Mobile Platform</h3>
    <form method="post" action="process_form.php">
    <!-- Add a hidden input field to pass the user_id -->
    <table id="mobile_platform_table">
        <thead>
            <tr>
                <th>Part Model</th>
                <th>Robot Class</th>
                <th>Description</th>
                <th>Progress</th>
                <th>Certification Status</th>
                <th>Certification Added Date</th>
                <th>Certification Expiration Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="part_model">
                        <!-- Options will be dynamically populated based on selection -->
                        <option value="Canova Platform 001">Canova Platform 001</option>
                        <option value="Canova Platform 002">Canova Platform 002</option>
                        <option value="Canova Platform 003">Canova Platform 003</option>
                        <option value="Canova Platform 004">Canova Platform 004</option>
                        <option value="Canova Platform 005">Canova Platform 005</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="class" value="mobile platform">
                </td>
                <td>
                    <input type="text" name="description" value="part description">
                </td>
                <td>
                    <input type="range" name="progress" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                    <span class="progress_value">50%</span>
                </td>
                <td>
                    <input type="text" name="cert_status" value="In Progress">
                </td>
                <td>
                    <input type="date" name="dateadded" value="2021-01-01">
                </td>
                <td>
                    <input type="date" name="expirationdate" value="2022-01-01">
                </td>
            </tr>
            <!-- Additional rows will be dynamically added here -->
        </tbody>
    </table>
    <!-- Move the submit button inside the form -->
    <button type="submit" class="submit">Submit</button>

    <!-- Robotic Arm Table -->
    <h3>Robotic Arm</h3>
        <table id="robotic_arm_table">
            <thead>
                <tr>
                    <th>Part Model</th>
                    <th>Robot Class</th>
                    <th>Description</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                    <th>Certification Added Date</th>
                    <th>Certification Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_model" onchange="populateEndEffectorDropdown(this)">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Canova Arm 001">Canova Arm 001</option>
                            <option value="Canova Arm 002">Canova Arm 002</option>
                            <option value="Canova Arm 003">Canova Arm 003</option>
                            <option value="Canova Arm 004">Canova Arm 004</option>
                            <option value="Canova Arm 005">Canova Arm 005</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="class" value="robotic arm">
                    </td>
                    <td>
                        <input type="text" name="description" value="part description">
                    </td>
                    <td>
                        <input type="range" name="progress" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                        <span class="progress_value">50%</span>
                    </td>
                    <td><input type="text" name="cert_status" value="In Progress"></td>
                    <td>
                        <input type="date" name="dateadded" value="2021-01-01">
                    </td>
                    <td>
                        <input type="date" name="expirationdate" value="2022-01-01">
                    </td>
                    </tr>
            </tbody>
        </table>
        <button type="submit" class="submit">Submit</button>


    <!-- VR Table -->
    <h3>VR</h3>
        <table id="vr_table">
            <thead>
                <tr>
                <th>Part Model</th>
                <th>Robot Class</th>
                    <th>Description</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                    <th>Certification Added Date</th>
                    <th>Certification Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_model">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Canova VR 001">Canova VR 001</option>
                            <option value="Canova VR 002">Canova VR 002</option>
                            <option value="Canova VR 003">Canova VR 003</option>
                            <option value="Canova VR 004">Canova VR 004</option>
                            <option value="Canova VR 005">Canova VR 005</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="class" value="vr">
                    </td>
                    <td>
                    <input type="text" name="description" value="part description">
                </td>
                <td>
                    <input type="range" name="progress" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                    <span class="progress_value">50%</span>
                </td>
                <td><input type="text" name="cert_status" value="In Progress"></td>
                <td>
                    <input type="date" name="dateadded" value="2021-01-01">
                </td>
                <td>
                    <input type="date" name="expirationdate" value="2022-01-01">
                </td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
    <button type="submit" class="submit">Submit</button>

<!-- VR Table -->
    <h3>End Effector</h3>
        <table id="effector_table">
            <thead>
                <tr>
                <th>Part Model</th>
                <th>Robot Class</th>
                    <th>Description</th>
                    <th>Progress</th>
                    <th>Certification Status</th>
                    <th>Certification Added Date</th>
                    <th>Certification Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_model">
                            <!-- Options will be dynamically populated based on selection -->
                            <option value="Claw">Claw</option>
                            <option value="Cutter">Cutter</option>
                            <option value="Hand">Hand</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="class" value="end effector">
                    </td>
                    <td>
                        <input type="text" name="description" value="part description">
                </td>
                <td>
                    <input type="range" name="progress" min="0" max="100" value="50" oninput="updateProgressValue(this)">
                    <span class="progress_value">50%</span>
                </td>
                <td><input type="text" name="cert_status" value="In Progress"></td>
                <td>
                    <input type="date" name="dateadded" value="2021-01-01">
                </td>
                <td>
                    <input type="date" name="expirationdate" value="2022-01-01">
                </td>
                </tr>
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
    </form>
    <button type="submit" class="submit">Submit</button>
</form>

<script>
    // Bind the updateProgressValue function to existing progress sliders
    var existingSliders = document.querySelectorAll('input[type="range"]');
    existingSliders.forEach(function(slider) {updateProgressValue(slider);
    });

        // Function to update the progress value display
        function updateProgressValue(slider) {
        var progressValueSpan = slider.parentNode.querySelector('.progress_value');
        progressValueSpan.innerHTML = slider.value + '%';
    }
</script>
</body>
</html>