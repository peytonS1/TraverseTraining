<?php
// Include the database connection
require 'db.php';

// Check if a user is selected
if(isset($_POST['selected_user'])) {
    $selected_user = $_POST['selected_user'];
}

// Search function to fetch users by last name
if(isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $query = "SELECT * FROM userprofile WHERE lastname LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    $users = [];
    while($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    echo json_encode($users);
    exit; // Stop further execution
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

<!-- Search function for selecting a user-->
<form method="post">
    <input type="text" name="search" id="search" placeholder="Search by last name...">
</form>
<div id="searchResults"></div>

<style>
/* CSS for highlighting on hover */
.user:hover {
    background-color: yellow; /* Change the color as needed */
    cursor: pointer;
}
</style>


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
</head>

<body style="background-color:White">
    <h2 class="centerTop">Training Log</h2>

    <!-- Display user's certification information -->
    <?php if ($is_admin && isset($selected_user)): ?>
        <!-- Editable table for administrator -->
        <table id="adminTable" style="display: none;">
            <thead>
                <tr>
                    <th>Certification Type</th>
                    <th>Progress</th>
                    <th>Description</th>
                    <th>Certification Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display certification information for the selected user -->
                <?php
                $query = "SELECT * FROM certification WHERE userprofileid = $selected_user";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['robotclass'] . "</td>";
                    echo "<td>" . $row['progress'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['certstatus'] . "</td>";
                    echo "</tr>";
                }
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

    <script>
    $(document).ready(function(){
        // Function to populate the admin table with user data
        function populateAdminTable(userId) {
            $.ajax({
                url: 'fetch_user_data.php', // Update with your PHP script to fetch user data
                method: 'POST',
                data: { user_id: userId },
                dataType: 'json',
                success: function(response) {
                    // Clear existing table rows
                    $('#adminTable tbody').empty();
                    // Populate table with user data
                    response.forEach(function(cert) {
                        $('#adminTable tbody').append(
                            '<tr>' +
                            '<td>' + cert.robotclass + '</td>' +
                            '<td>' + cert.progress + '</td>' +
                            '<td>' + cert.description + '</td>' +
                            '<td>' + cert.certstatus + '</td>' +
                            '</tr>'
                        );
                    });
                    // Show the admin table
                    $('#adminTable').show();
                }
            });
        }

        // Click event for user rows
        $(document).on('click', '.user', function() {
            var userId = $(this).data('userid');
            populateAdminTable(userId);
        });

        // Search function
        $('#search').on('input', function(){
            var searchValue = $(this).val();
            $.ajax({
                url: 'search_users.php',
                method: 'POST',
                data: { search: searchValue },
                dataType: 'json',
                success: function(response) {
                    var html = '';
                    response.forEach(function(user) {
                        html += '<div class="user" data-userid="' + user.userprofileid + '">' + user.lastname + '</div>';
                    });
                    $('#searchResults').html(html);
                }
            });
        });

    });
    </script>
</body>
</html>
