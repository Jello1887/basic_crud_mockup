<?php
session_start();
require 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the email and password from the form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['pword']; // Password will be verified, not sanitized

    // Prepare a SELECT statement to fetch the user data
    $query = "SELECT user_id, email_address, password, role, first_name, last_name FROM USER WHERE email_address = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (!password_verify($password, $user['password'])) {
            echo "The password entered is incorrect.";
        } else if ($user['role'] !== 'A') {
            // Check if the user's role is not 'A' (admin)
            echo "You don't have the correct role required for access.";
        } else {
            // User is an admin and password is correct
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['logged_in'] = true; // You can use this to check if the user is logged in

            // Redirect to user_list.php on successful login
            header("Location: user_list.php");
            exit;
        }
    } else {
        echo "No user found with the provided email address.";
    }

    $stmt->close();
} else {
    // Redirect back to the login page if the script is accessed without a POST request
    header("Location: login.php");
    exit;
}
?>
