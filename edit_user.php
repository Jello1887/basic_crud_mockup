<?php
$pageTitle = 'Edit User';
include 'includes/header_session.php';
require 'connect_db.php';

// Check if user_id is set in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare a SELECT statement to fetch the user data
    $query = "SELECT * FROM USER WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId); 
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        echo "No user found with ID " . $userId;
        // Handle the case where no user is found
    }
    $stmt->close();
} else {
    echo "No user ID provided";
    // Redirect or handle the case where no user ID is in the URL
}
?>
<body>
<div class="oj-form-wrap">
<?php if (isset($userData)): ?>
    <form action="update_user.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userData['user_id']); ?>">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($userData['first_name']); ?>"><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($userData['last_name']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userData['email_address']); ?>"><br>
        
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="A" <?php echo $userData['role'] == 'A' ? 'selected' : ''; ?>>Admin</option>
            <option value="U" <?php echo $userData['role'] == 'U' ? 'selected' : ''; ?>>User</option>
        </select><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($userData['password']); ?>"><br>

        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($userData['city']); ?>"><br>

        <!-- State Field -->
        <label for="state">State:</label>
        <select name="state" id="state">
            <option value="AL" <?php echo $userData['state'] == 'AL' ? 'selected' : ''; ?>>Alabama</option>
            <option value="AK" <?php echo $userData['state'] == 'AK' ? 'selected' : ''; ?>>Alaska</option>
            <option value="AZ" <?php echo $userData['state'] == 'AZ' ? 'selected' : ''; ?>>Arizona</option>
            <option value="AR" <?php echo $userData['state'] == 'AR' ? 'selected' : ''; ?>>Arkansas</option>
            <option value="CA" <?php echo $userData['state'] == 'CA' ? 'selected' : ''; ?>>California</option>
            <option value="CO" <?php echo $userData['state'] == 'CO' ? 'selected' : ''; ?>>Colorado</option>
            <option value="CT" <?php echo $userData['state'] == 'CT' ? 'selected' : ''; ?>>Connecticut</option>
            <option value="DE" <?php echo $userData['state'] == 'DE' ? 'selected' : ''; ?>>Delaware</option>
            <option value="FL" <?php echo $userData['state'] == 'FL' ? 'selected' : ''; ?>>Florida</option>
            <option value="GA" <?php echo $userData['state'] == 'GA' ? 'selected' : ''; ?>>Georgia</option>
            <option value="HI" <?php echo $userData['state'] == 'HI' ? 'selected' : ''; ?>>Hawaii</option>
            <option value="ID" <?php echo $userData['state'] == 'ID' ? 'selected' : ''; ?>>Idaho</option>
            <option value="IL" <?php echo $userData['state'] == 'IL' ? 'selected' : ''; ?>>Illinois</option>
            <option value="IN" <?php echo $userData['state'] == 'IN' ? 'selected' : ''; ?>>Indiana</option>
            <option value="IA" <?php echo $userData['state'] == 'IA' ? 'selected' : ''; ?>>Iowa</option>
            <option value="KS" <?php echo $userData['state'] == 'KS' ? 'selected' : ''; ?>>Kansas</option>
            <option value="KY" <?php echo $userData['state'] == 'KY' ? 'selected' : ''; ?>>Kentucky</option>
            <option value="LA" <?php echo $userData['state'] == 'LA' ? 'selected' : ''; ?>>Louisiana</option>
            <option value="ME" <?php echo $userData['state'] == 'ME' ? 'selected' : ''; ?>>Maine</option>
            <option value="MD" <?php echo $userData['state'] == 'MD' ? 'selected' : ''; ?>>Maryland</option>
            <option value="MA" <?php echo $userData['state'] == 'MA' ? 'selected' : ''; ?>>Massachusetts</option>
            <option value="MI" <?php echo $userData['state'] == 'MI' ? 'selected' : ''; ?>>Michigan</option>
            <option value="MN" <?php echo $userData['state'] == 'MN' ? 'selected' : ''; ?>>Minnesota</option>
            <option value="MS" <?php echo $userData['state'] == 'MS' ? 'selected' : ''; ?>>Mississippi</option>
            <option value="MO" <?php echo $userData['state'] == 'MO' ? 'selected' : ''; ?>>Missouri</option>
            <option value="MT" <?php echo $userData['state'] == 'MT' ? 'selected' : ''; ?>>Montana</option>
            <option value="NE" <?php echo $userData['state'] == 'NE' ? 'selected' : ''; ?>>Nebraska</option>
            <option value="NV" <?php echo $userData['state'] == 'NV' ? 'selected' : ''; ?>>Nevada</option>
            <option value="NH" <?php echo $userData['state'] == 'NH' ? 'selected' : ''; ?>>New Hampshire</option>
            <option value="NJ" <?php echo $userData['state'] == 'NJ' ? 'selected' : ''; ?>>New Jersey</option>
            <option value="NM" <?php echo $userData['state'] == 'NM' ? 'selected' : ''; ?>>New Mexico</option>
            <option value="NY" <?php echo $userData['state'] == 'NY' ? 'selected' : ''; ?>>New York</option>
            <option value="NC" <?php echo $userData['state'] == 'NC' ? 'selected' : ''; ?>>North Carolina</option>
            <option value="ND" <?php echo $userData['state'] == 'ND' ? 'selected' : ''; ?>>North Dakota</option>
            <option value="OH" <?php echo $userData['state'] == 'OH' ? 'selected' : ''; ?>>Ohio</option>
            <option value="OK" <?php echo $userData['state'] == 'OK' ? 'selected' : ''; ?>>Oklahoma</option>
            <option value="OR" <?php echo $userData['state'] == 'OR' ? 'selected' : ''; ?>>Oregon</option>
            <option value="PA" <?php echo $userData['state'] == 'PA' ? 'selected' : ''; ?>>Pennsylvania</option>
            <option value="RI" <?php echo $userData['state'] == 'RI' ? 'selected' : ''; ?>>Rhode Island</option>
            <option value="SC" <?php echo $userData['state'] == 'SC' ? 'selected' : ''; ?>>South Carolina</option>
            <option value="SD" <?php echo $userData['state'] == 'SD' ? 'selected' : ''; ?>>South Dakota</option>
            <option value="TN" <?php echo $userData['state'] == 'TN' ? 'selected' : ''; ?>>Tennessee</option>
            <option value="TX" <?php echo $userData['state'] == 'TX' ? 'selected' : ''; ?>>Texas</option>
            <option value="UT" <?php echo $userData['state'] == 'UT' ? 'selected' : ''; ?>>Utah</option>
            <option value="VT" <?php echo $userData['state'] == 'VT' ? 'selected' : ''; ?>>Vermont</option>
            <option value="VA" <?php echo $userData['state'] == 'VA' ? 'selected' : ''; ?>>Virginia</option>
            <option value="WA" <?php echo $userData['state'] == 'WA' ? 'selected' : ''; ?>>Washington</option>
            <option value="WV" <?php echo $userData['state'] == 'WV' ? 'selected' : ''; ?>>West Virginia</option>
            <option value="WI" <?php echo $userData['state'] == 'WI' ? 'selected' : ''; ?>>Wisconsin</option>
            <option value="WY" <?php echo $userData['state'] == 'WY' ? 'selected' : ''; ?>>Wyoming</option>
        </select><br>
        <!--State Field End -->

        <!-- Profile Picture Upload Field -->
    <label for="profile_picture">Profile Picture:</label>
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"><br>

        <!-- Submit Button -->
    <input type="submit" value="Update User">
    </form>
<?php endif; ?>
</div>
</body>
</html>
