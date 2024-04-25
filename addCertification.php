<?php
// Include the database connection
require 'db.php';

// Fetch users from the database
$query = "SELECT userprofileid, lastname FROM userprofile";
$result = mysqli_query($conn, $query);

// Display the form to select a user
echo '<form method="post">';
echo '<select name="selected_user">';
echo '<option value="" selected disabled>Select a user</option>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['userprofileid'] . '">' . $row['lastname'] . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Select User">';
echo '</form>';

// Handle form submissions for each certification table
if(isset($_POST['selected_user'])) {
    $user_id = $_POST['selected_user'];

    // Form for Mobile Platform table
    echo '<form method="post" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
    echo '<label for="mobile_platform_part_model">Part Model:</label>';
    echo '<select name="mobile_platform_part_model">';
    echo '<option value="Canova Platform 001">Canova Platform 001</option>';
    echo '<option value="Canova Platform 002">Canova Platform 002</option>';
    echo '<option value="Canova Platform 003">Canova Platform 003</option>';
    echo '<option value="Canova Platform 004">Canova Platform 004</option>';
    echo '<option value="Canova Platform 005">Canova Platform 005</option>';
    echo '</select>';

    echo '<label for="robot_class">Robot Class:</label>';
    echo '<input type="text" name="robot_class">';

    echo '<label for="description">Description:</label>';
    echo '<input type="text" name="description">';

    echo '<label for="progress">Progress Percent:</label>';
    echo '<input type="text" name="progress"';

    echo '<label for="cert_status">Certification Status:</label>';
    echo '<select name="cert_status">';
    echo '<option value="In Progress">In Progress</option>';
    echo '<option value="Complete">Complete</option>';
    echo '</select>';

    // Add input fields for Robot Class, Description, Progress, Certification Status, Certification Added Date, Certification Expiration Date
    echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
    echo '<input type="submit" name="submit_mobile_platform" value="Submit">';
    echo '</form>';

    // Form for Robotic Arm table
    echo '<form method="post" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
    echo '<label for="robotic_arm_part_model">Part Model:</label>';
    echo '<select name="robotic_arm_part_model">';
    echo '<option value="Canova Arm 001">Canova Arm 001</option>';
    echo '<option value="Canova Arm 002">Canova Arm 002</option>';
    echo '<option value="Canova Arm 003">Canova Arm 003</option>';
    echo '<option value="Canova Arm 004">Canova Arm 004</option>';
    echo '<option value="Canova Arm 005">Canova Arm 005</option>';
    echo '</select>';

    echo '<label for="robot_class">Robot Class:</label>';
    echo '<input type="text" name="robot_class">';

    echo '<label for="description">Description:</label>';
    echo '<input type="text" name="description">';

    echo '<label for="progress">Progress Percent:</label>';
    echo '<input type="text" name="progress"';

    echo '<label for="cert_status">Certification Status:</label>';
    echo '<select name="cert_status">';
    echo '<option value="In Progress">In Progress</option>';
    echo '<option value="Complete">Complete</option>';
    echo '</select>';

    echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
    echo '<input type="submit" name="submit_robotic_arm" value="Submit">';
    echo '</form>';

    // Form for VR table
    echo '<form method="post" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
    echo '<label for="vr_part_model">Part Model:</label>';
    echo '<select name="vr_part_model">';
    echo '<option value="Canova VR 001">Canova VR 001</option>';
    echo '<option value="Canova VR 002">Canova VR 002</option>';
    echo '<option value="Canova VR 003">Canova VR 003</option>';
    echo '<option value="Canova VR 004">Canova VR 004</option>';
    echo '<option value="Canova VR 005">Canova VR 005</option>';
    echo '</select>';

    echo '<label for="robot_class">Robot Class:</label>';
    echo '<input type="text" name="robot_class">';

    echo '<label for="description">Description:</label>';
    echo '<input type="text" name="description">';

    echo '<label for="progress">Progress Percent:</label>';
    echo '<input type="text" name="progress">';

    echo '<label for="cert_status">Certification Status:</label>';
    echo '<select name="cert_status">';
    echo '<option value="In Progress">In Progress</option>';
    echo '<option value="Complete">Complete</option>';
    echo '</select>';

    echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
    echo '<input type="submit" name="submit_vr" value="Submit">';
    echo '</form>';

    // Form for End Effector table
    echo '<form method="post" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
    echo '<label for="end_effector_part_model">Part Model:</label>';
    echo '<select name="end_effector_part_model">';
    echo '<option value="Claw">Claw</option>';
    echo '<option value="Hand">Hand</option>';
    echo '<option value="Cutter">Cutter</option>';
    echo '</select>';

    echo '<label for="robot_class">Robot Class:</label>';
    echo '<input type="text" name="robot_class">';

    echo '<label for="description">Description:</label>';
    echo '<input type="text" name="description">';

    echo '<label for="progress">Progress Percent:</label>';
    echo '<input type="text" name="progress">';

    echo '<label for="cert_status">Certification Status:</label>';
    echo '<select name="cert_status">';
    echo '<option value="In Progress">In Progress</option>';
    echo '<option value="Complete">Complete</option>';
    echo '</select>';

    echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
    echo '<input type="submit" name="submit_end_effector" value="Submit">';
    echo '</form>';
}

// Handle form submissions for each certification table
if(isset($_POST['submit_mobile_platform'])) {
    // Process form submission for Mobile Platform table
    $user_id = $_POST['user_id'];
    $part_model = $_POST['mobile_platform_part_model'];
    $robot_class = $_POST['robot_class'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $cert_status = $_POST['cert_status'];


    // Retrieve other form fields and perform database insertion for Mobile Platform table
    $query = "INSERT INTO certification (userprofileid, partmodel, robotclass, description, progress, certstatus) 
    VALUES ('$user_id', '$part_model', '$robot_class', '$description', '$progress', '$cert_status')";

    // Check if insertion was successful
    if(mysqli_query($conn, $query)) {
        // Alert if database insertion was successful
        echo '<script>alert("Database has been updated.");</script>';
    } else {
        // Alert if there was an error in database insertion
        echo '<script>alert("Error updating database.");</script>';
    }
}

if(isset($_POST['submit_robotic_arm'])) {
    // Process form submission for Robotic Arm table
    $user_id = $_POST['user_id'];
    $part_model = $_POST['robotic_arm_part_model'];
    $robot_class = $_POST['robot_class'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $cert_status = $_POST['cert_status'];

    // Retrieve other form fields and perform database insertion for Robotic Arm table
    $query = "INSERT INTO certification (user_id, part_model, robot_class, description, progress, cert_status) 
    VALUES ('$user_id', '$part_model', '$robot_class', '$description', '$progress', '$cert_status')";
}

if(isset($_POST['submit_vr'])) {
    // Process form submission for VR table
    $user_id = $_POST['user_id'];
    $part_model = $_POST['vr_part_model'];
    $robot_class = $_POST['robot_class'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $cert_status = $_POST['cert_status'];

    // Retrieve other form fields and perform database insertion for VR table
    $query = "INSERT INTO certification (user_id, part_model, robot_class, description, progress, cert_status) 
    VALUES ('$user_id', '$part_model', '$robot_class', '$description', '$progress', '$cert_status')";
}

if(isset($_POST['submit_end_effector'])) {
    // Process form submission for End Effector table
    $user_id = $_POST['user_id'];
    $part_model = $_POST['end_effector_part_model'];
    $robot_class = $_POST['robot_class'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $cert_status = $_POST['cert_status'];

    // Retrieve other form fields and perform database insertion for End Effector table
    $query = "INSERT INTO certification (user_id, part_model, robot_class, description, progress, cert_status) 
    VALUES ('$user_id', '$part_model', '$robot_class', '$description', '$progress', '$cert_status')";
}

// Implement submission handling for VR and End Effector tables similarly
?>
