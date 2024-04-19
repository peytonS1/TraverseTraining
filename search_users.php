<?php
// Include the database connection
require 'db.php';

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
