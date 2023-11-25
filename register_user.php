<?php
$pageTitle = 'Register User';
include 'includes/header.php';
require 'connect_db.php';
?>
<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Prepare a statement to check if email exists
    $query = $connection->prepare("SELECT * FROM USER WHERE email_address = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Redirect to add_user_failed.php if email exists
        header("Location: add_user_failed.php");
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare a statement to insert new user
        $insertQuery = $connection->prepare("INSERT INTO USER (email_address, password, first_name, last_name, city, state) VALUES (?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("ssssss", $email, $hashedPassword, $firstName, $lastName, $city, $state);

        if ($insertQuery->execute()) {
            // Redirect to add_user_success.php after successful insertion
            header("Location: add_user_success.php");
            exit();
        } else {
            echo "Error: " . $insertQuery->error;
        }
    }
} else {
    // Redirect or display an error if the form wasn't submitted
    echo "Invalid request.";
}
?>
