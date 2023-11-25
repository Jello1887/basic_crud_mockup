<?php
$pageTitle = 'Restore User';
include 'includes/header.php';
require 'connect_db.php';
// Check if user_id is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare a SQL statement to update the user status
    $query = $connection->prepare("UPDATE USER SET status = 'A' WHERE user_id = ?");
    $query->bind_param("i", $userId); // Bind the user_id as an integer

    if ($query->execute()) {
        // Redirect to user_list page after successful update
        header("Location: /project4/user_list");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }
} else {
    // Handle the case where user_id is not set or not valid
    echo "Invalid request.";
}
?>