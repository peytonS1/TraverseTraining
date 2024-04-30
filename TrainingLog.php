<?php
// Include the database connection
require 'db.php';


// Check if a user is selected
if(isset($_POST['selected_user'])) {
    $_SESSION['selected_user'] = $_POST['selected_user']; // Save selected user's ID in session
}

$logged_in_user_id = isset($_SESSION['selected_user']) ? $_SESSION['selected_user'] : null;

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
    /* CSS for Search Results */
    #searchResults {
        margin-top: 10px;
        width: 200px; 
        height: 100px; 
        padding: 5px; 
        margin: 1px; 
     }
    .user {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        background-color: #f9f9f9;
    }
    .user:hover {
        background-color: yellow;
    }
/* Add CSS for table borders */
table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
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
        <!-- Table for administrator -->
        <table id="adminTable">
            <thead>
                <tr>
                    <th>Certification Type</th>
                    <th>Progress %</th>
                    <th>Description</th>
                    <th>Certification Status</th>
                    <th>Certification Added Date</th>
                    <th>Certification Expiration Date</th>
                    <th>Edit</th>
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
                    echo "<td>" . $row['dateadded'] . "</td>";
                    echo "<td>" . $row['expirationdate'] . "</td>";
                    echo "<td><a href='editCertification.php?user_id=" . $row['userprofileid'] . "&cert_id=" . $row['cert_id'] . "'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="addCertification.php" class="button">Add Certification</a>
        
        <?php else: ?>
        <!-- Uneditable table for normal users -->
        <table id="certificationTable">
            <thead>
                <tr>
                    <th>Certification Type</th>
                    <th>Progress %</th>
                    <th>Description</th>
                    <th>Certification Status</th>
                    <th>Certification Added Date</th>
                    <th>Certification Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display certification information for the selected user -->
                <?php
                // Fetch certification information from the database for the selected user
                // Display information in table rows
                $query = "SELECT * FROM certification WHERE userprofileid = $logged_in_user_id";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['robotclass'] . "</td>";
                    echo "<td>" . $row['progress'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['certstatus'] . "</td>";
                    echo "<td>" . $row['dateadded'] . "</td>";
                    echo "<td>" . $row['expirationdate'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
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
                            '<td>' + cert.dateadded + '</td>' +
                            '<td>' + cert.expirationdate + '</td>' +
                            '<td><a href="editCertification.php?user_id=' + cert.userprofileid + '&cert_id=' + cert.certid +'">Edit</a></td>'+ // Edit button with user ID as parameter
                            '</tr>'
                        );
                    });
                    // Show the admin table
                    $('#adminTable').show();
                }
            });
        }

        function populateAddTable(userIdAdd) {
            $.ajax({
                url: 'fetch_user_data.php', // to fetch user data
                method: 'POST',
                data: { user_id: userIdAdd },
                dataType: 'json',
                success: function(response) {
                    // Clear existing table rows
                    $('#addTable tbody').empty();
                    // Populate table with user data
                    response.forEach(function(cert) {
                        $('#addTable tbody').append(
                            '<tr>' +
                            '<td><a href="Certification.php?user_id=' + cert.userprofileid + '">Edit</a></td>'+ // Edit button with user ID as parameter
                            '</tr>'
                        );
                    });
                    // Show the admin table
                    $('#addTable').show();
                }
            });
        }

        // Click event for user rows
        $(document).on('click', '.user', function() {
            var userId = $(this).data('userid');
            // Save selected user's ID in session
            $.ajax({
                url: 'save_selected_user.php', //to save selected user in session
                method: 'POST',
                data: { admin_selected_user: userId },
                success: function(response) {
                    // If session saved successfully, populate admin table
                    populateAdminTable(userId);
                    alert("You have selected the user: " + lastname);
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(error);
                }
            });
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

    $(document).ready(function(){
        // Function to populate the user table with user data
        function populateUserTable(userId) {
            $.ajax({
                url: 'fetch_user_data.php', // to fetch user data
                method: 'POST',
                data: { user_id: userId },
                dataType: 'json',
                success: function(response) {
                    // Clear existing table rows
                    $('#certificationTable tbody').empty();
                    // Populate table with user data
                    response.forEach(function(cert) {
                        $('#certificationTable tbody').append(
                            '<tr>' +
                            '<td>' + cert.robotclass + '</td>' +
                            '<td>' + cert.progress + '</td>' +
                            '<td>' + cert.description + '</td>' +
                            '<td>' + cert.certstatus + '</td>' +
                            '<td>' + cert.dateadded + '</td>' +
                            '<td>' + cert.expirationdate + '</td>' +
                            '</tr>'
                        );
                    });
                    // Show the user table
                    $('#certificationTable').show();
                }
            });
        }
    });

    </script>
</body>
</html>
