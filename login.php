<?php
    $pageTitle = 'Login';
    require("includes/header_public.php");
    ?>
    <div class="oj-form-wrap">
    <h1>Login Form</h1>
    <!-- form starts-->
    <form name="login" method="POST" action="process_login.php">
        <label for="email">Email Address</label>
        <input type="text" name="email" placeholder="Email Address" required><br>
        <label for="password">Password</label>
        <input type="password" name="pword" placeholder="Enter your password" required><br>
        <input type="submit">
</form>
</div>
</body>
</html> 