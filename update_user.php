<?php
require 'connect_db.php';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize the input data
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);

    // Prepare the SQL statement
    $query = "UPDATE USER SET first_name = ?, last_name = ?, email_address = ?, role = ?, city = ?, state = ?";
    $types = "ssssss"; // Data types for each parameter

    // Check if the password needs to be updated
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the new password
        $query .= ", password = ?";
        $types .= "s"; // Add a string data type for the password
    }

    $query .= " WHERE user_id = ?";
    $types .= "i"; // Add an integer data type for the user_id

    $stmt = $connection->prepare($query);
    
    // Bind parameters based on whether the password is updated
    if (!empty($password)) {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $password, $userId);
    } else {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $userId);
    }

    // Execute the query and check for successful update
    if ($stmt->execute()) {
        header("Location: user_list.php"); // Redirect to user list on success
        exit;
    } else {
        header("Location: update_user_failed.php"); // Redirect to error page on failure
        exit;
    }
} else {
    // Redirect to the update form if the script is accessed without a POST request
    header("Location: update_user.php");
    exit;
}
?>
