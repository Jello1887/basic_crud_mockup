<?php
$pageTitle = 'User List';
include 'includes/header.php';
require 'connect_db.php';
?>
<body>
    <section>
        <h1>User List</h1>
        <div class="oj-users-wrap">
        <?php
    $query = "SELECT * FROM USER";
    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $statusClass = $row['status'] == 'I' ? 'oj-inactive' : '';
            $statusText = $row['status'] == 'I' ? 'Inactive' : 'Active';
            $deleteIcon = $row['status'] == 'I' ? 'fa-trash-arrow-up' : 'fa-trash';
            $deleteTitle = $row['status'] == 'I' ? 'restore user' : 'delete user';
            $deleteUrl = $row['status'] == 'I' ? 'restore_user.php?id=' . $row['user_id'] : 'delete_user.php?id=' . $row['user_id'];


            echo "<div class='oj-user-box'>";
            echo "<div class='oj-edit-bar {$statusClass}'>";
            echo "<span class='oj-user-id'>User ID: " . str_pad(htmlspecialchars($row['user_id']), 3, '0', STR_PAD_LEFT) . "</span>";
            echo "<div class='oj-icon-wrap'>";
            echo "<a href='#' title='edit user'><i class='fa-solid fa-pen-to-square'></i></a>";
            echo "<a href='{$deleteUrl}' title='{$deleteTitle}'><i class='fa-solid {$deleteIcon}'></i></a>";
            echo "</div>";
            echo "</div>";
            echo "<h2>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</h2>";
            echo "<p><b>Email:</b> " . htmlspecialchars($row['email_address']) . "</p>";
            echo "<p><b>Location:</b> " . htmlspecialchars($row['city']) . ", " . htmlspecialchars($row['state']) . "</p>";
            echo "<p><b>Status:</b> {$statusText}</p>";
            echo "</div>";
        }
    } else {
        echo "Error in query execution: " . mysqli_error($connection);
    }
?>
        </div>
    </section>
</body>
</html>

