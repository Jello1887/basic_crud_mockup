<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $pageTitle; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project4/css/styles.css">
<script src="https://kit.fontawesome.com/f981833bfb.js" crossorigin="anonymous"></script>
</head>
<header>
    <nav class="oj-nav">
        <!-- in the PHP here we checking if the current script name is the same as the href (with or without the .php at the end) and then applying the .active class if there is a match !-->
        <a href="user_list" class="<?php echo (basename($_SERVER['SCRIPT_NAME']) == 'user_list.php' || basename($_SERVER['REQUEST_URI'], '.php') == 'user_list') ? 'active' : ''; ?>">User List</a>
        <a href="add_user" class="<?php echo (basename($_SERVER['SCRIPT_NAME']) == 'add_user.php' || basename($_SERVER['REQUEST_URI'], '.php') == 'add_user') ? 'active' : ''; ?>">Add User</a>
    </nav>
</header>