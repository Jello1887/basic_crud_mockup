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

    // Initialize variables for the profile picture
    $profilePicPath = '';
    $oldProfilePicPath = '';

    // Initialize the SQL query and types string
    $query = "UPDATE USER SET first_name = ?, last_name = ?, email_address = ?, role = ?, city = ?, state = ?";
    $types = "ssssss";

    // Check if the password needs to be updated
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the new password
        $query .= ", password = ?";
        $types .= "s";
    }

    // Check if a new profile picture is uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['profile_picture']['name']);
        $targetFilePath = $targetDir . time() . '_' . $fileName; // Unique file name
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file is an image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check file size (e.g., 5MB limit)
        if ($_FILES['profile_picture']['size'] > 5000000) {
            die("Sorry, your file is too large.");
        }

        // Allow certain file formats
        if (!in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Get the old profile picture path from the database
        $selectQuery = $connection->prepare("SELECT profile_picture FROM USER WHERE user_id = ?");
        $selectQuery->bind_param("i", $userId);
        $selectQuery->execute();
        $result = $selectQuery->get_result();
        if ($row = $result->fetch_assoc()) {
            $oldProfilePicPath = $row['profile_picture'];
        }

        // Try to upload the new file
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            $profilePicPath = $targetFilePath;
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    }

    // Append profile picture to the query
    if (!empty($profilePicPath)) {
        $query .= ", profile_picture = ?";
        $types .= "s";
    }

    $query .= " WHERE user_id = ?";
    $types .= "i";

    $stmt = $connection->prepare($query);

    // Bind parameters based on whether the password and profile picture are updated
    if (!empty($password) && !empty($profilePicPath)) {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $password, $profilePicPath, $userId);
    } elseif (!empty($password)) {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $password, $userId);
    } elseif (!empty($profilePicPath)) {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $profilePicPath, $userId);
    } else {
        $stmt->bind_param($types, $firstname, $lastname, $email, $role, $city, $state, $userId);
    }

    // Execute the query
    if ($stmt->execute()) {
        // Delete the old profile picture if a new one was uploaded
        if (!empty($profilePicPath) && !empty($oldProfilePicPath) && file_exists($oldProfilePicPath)) {
            unlink($oldProfilePicPath);
        }

        header("Location: user_list.php"); // Redirect on success
    } else {
        header("Location: update_user_failed.php"); // Redirect on failure
    }
    exit;
} else {
    header("Location: user_list.php"); // Redirect if not a POST request
    exit;
}
?>

