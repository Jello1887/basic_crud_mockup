<?php
$pageTitle = 'Register User';
include 'includes/header.php';
require 'connect_db.php';

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
       // Handle File Upload
    $profilePicPath = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['profile_picture']['name']);
        $targetFilePath = $targetDir . time() . '_' . $fileName;  // Adding a timestamp for uniqueness
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if($check === false) {
            die("File is not an image.");
        }

        // Check file size (e.g., 5MB limit)
        if ($_FILES['profile_picture']['size'] > 5000000) {
            die("Sorry, your file is too large. Maximum allowed size is 5MB.");
        }

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($fileType, $allowTypes)) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Check if file already exists
        if (file_exists($targetFilePath)) {
            die("Sorry, file already exists. Please try again.");
        }

        // Try to upload file
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            die("Sorry, there was an error uploading your file.");
        }

        $profilePicPath = $targetFilePath;
    }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare a statement to insert new user with profile picture
        $insertQuery = $connection->prepare("INSERT INTO USER (email_address, password, first_name, last_name, city, state, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssssss", $email, $hashedPassword, $firstName, $lastName, $city, $state, $profilePicPath);

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

