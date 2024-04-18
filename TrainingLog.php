<?php
// Include the database connection
require 'db.php';

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
                echo "<option value='" . $row['userprofileid'] . "'>" . $row['lastname'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Select User">
    </form>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body style="background-color:White">
    <h2 class="centerTop">Dashboard</h2>

    <!-- Display user's certification information -->
    <?php if ($is_admin): ?>
        <!-- Editable table for administrator -->
        <table>
            <thead>
                <tr>
                    <th>Certification Type</th>
                    <th>Progress</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display certification information for the selected user -->
                <?php
                // Fetch certification information from the database for the selected user
                // Display information in table rows
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Uneditable table for normal users -->
        <table>
            <thead>
                <tr>
                    <th>Certification Type</th>
                    <th>Progress</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display certification information for the selected user -->
                <?php
                // Fetch certification information from the database for the selected user
                // Display information in table rows
                ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Button to go to Certification.php page to edit user's certification info -->
    <?php if ($is_admin): ?>
        <button onclick="window.location.href='Certification.php'">Edit Certification Info</button>
    <?php endif; ?>
</body>
</html>
