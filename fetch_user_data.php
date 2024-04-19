<?php
// Include the database connection
require 'db.php';

// Check if user ID is provided in the request
if(isset($_POST['user_id'])) {
    // Sanitize the user ID to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Construct the SQL query to fetch user data by ID
    $query = "SELECT * FROM certification WHERE userprofileid = '$user_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if any rows are returned
    if(mysqli_num_rows($result) > 0) {
        // Create an array to store user data
        $user_data = array();

        // Loop through the rows and fetch user data
        while($row = mysqli_fetch_assoc($result)) {
            // Add user data to the array
            $user_data[] = $row;
        }

        // Send JSON response with user data
        echo json_encode($user_data);
    } else {
        // If no user data found
        echo json_encode(array('message' => 'No user data found.'));
    }
} else {
    // If user ID is not provided in the request
    echo json_encode(array('message' => 'User ID is required.'));
}
?>
