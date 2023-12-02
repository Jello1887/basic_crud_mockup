<?php
$pageTitle = 'Add User';
include 'includes/header_session.php';
?>
<body>
    <div class="oj-form-wrap">
    <h1>User Registration</h1>
    <form method="post" action="register_user.php" enctype="multipart/form-data">
    <!-- First Name Field -->    
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br>

    <!-- Last Name Field -->
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br>

    <!-- Email Field -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <!-- City Field -->
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required><br>

    <!-- State Field -->
    <label for="state">State:</label>
    <select name="state" id="state">
    <option value="AL">Alabama</option>
    <option value="AK">Alaska</option>
    <option value="AZ">Arizona</option>
    <option value="AR">Arkansas</option>
    <option value="CA">California</option>
    <option value="CO">Colorado</option>
    <option value="CT">Connecticut</option>
    <option value="DE">Delaware</option>
    <option value="FL">Florida</option>
    <option value="GA">Georgia</option>
    <option value="HI">Hawaii</option>
    <option value="ID">Idaho</option>
    <option value="IL">Illinois</option>
    <option value="IN">Indiana</option>
    <option value="IA">Iowa</option>
    <option value="KS">Kansas</option>
    <option value="KY">Kentucky</option>
    <option value="LA">Louisiana</option>
    <option value="ME">Maine</option>
    <option value="MD">Maryland</option>
    <option value="MA">Massachusetts</option>
    <option value="MI">Michigan</option>
    <option value="MN">Minnesota</option>
    <option value="MS">Mississippi</option>
    <option value="MO">Missouri</option>
    <option value="MT">Montana</option>
    <option value="NE">Nebraska</option>
    <option value="NV">Nevada</option>
    <option value="NH">New Hampshire</option>
    <option value="NJ">New Jersey</option>
    <option value="NM">New Mexico</option>
    <option value="NY">New York</option>
    <option value="NC">North Carolina</option>
    <option value="ND">North Dakota</option>
    <option value="OH">Ohio</option>
    <option value="OK">Oklahoma</option>
    <option value="OR">Oregon</option>
    <option value="PA">Pennsylvania</option>
    <option value="RI">Rhode Island</option>
    <option value="SC">South Carolina</option>
    <option value="SD">South Dakota</option>
    <option value="TN">Tennessee</option>
    <option value="TX">Texas</option>
    <option value="UT">Utah</option>
    <option value="VT">Vermont</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
</select><br>

    <!-- Password Field -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <!-- Picture Field -->
    <label for="profile_picture">Profile Picture:</label>
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"><br>

    <!-- Submit Button -->
    <input type="submit" value="Submit">
</form>

</div>

</body>


</html>
</body>


</html>
