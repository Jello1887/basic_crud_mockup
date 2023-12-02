<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $pageTitle; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project4/css/styles.css">
<script src="https://kit.fontawesome.com/f981833bfb.js" crossorigin="anonymous"></script>
<script src="functions.js"></script>
</head>
<header>
<?php
session_start();

if(isset($_SESSION['user_id']) && $_SESSION['role']) {
    // Admin bar
    echo '<div class="admin-bar">';
    echo 'Hello, ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
    echo '<a href="logout.php" class="logout-button">Logout</a>';
    echo '</div>';

    // Navigation bar
    echo '<nav class="oj-nav">';
    echo '<a href="user_list" class="' . (basename($_SERVER['SCRIPT_NAME']) == 'user_list.php' ? 'active' : '') . '">User List</a>';
    echo '<a href="add_user" class="' . (basename($_SERVER['SCRIPT_NAME']) == 'add_user.php' ? 'active' : '') . '">Add User</a>';
    echo '</nav>';
}
else {
    // Redirect non-admin users to the login page or another appropriate page
    header('Location: login.php');
    exit();
}
?>
</header>
<body>
