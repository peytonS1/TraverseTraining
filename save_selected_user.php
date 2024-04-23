<?php
// Start the session to access session variables
session_start();

// Check if the selected user ID is received via POST method
if(isset($_POST['admin_selected_user'])) {
    // Sanitize and store the selected user ID in the session
    $_SESSION['admin_selected_user'] = $_POST['admin_selected_user'];
    // Return a success message or any other relevant response if needed
    echo "User ID saved in session successfully!";
} else {
    // If the selected user ID is not received, return an error message or handle the situation accordingly
    echo "Error: Selected user ID not provided!";
}
?>
