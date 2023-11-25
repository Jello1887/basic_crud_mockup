

<?php

//Connect to the database - use these values if you are using my webserver, just change your db name to your own
$host = "localhost"; 
$user = "ojones_ojonesweb"; //Your database username Does not change
$pass = "password"; // Your database user password
$db = "ojones_project_4"; //Your database name you want to connect to - add your number to the end of this
$port = 3306; //The port #. It is always 3306

// Try to make a database connection
$connection = mysqli_connect($host, $user, $pass, $db, $port); // Catch any connection errors
if(mysqli_connect_errno()) {
die("Database connection failed: " .
mysqli_connect_error() .
" (" .mysqli_connect_errno() . ")"
);
}

// If no errors, you can proceed with your sql queries

?>
