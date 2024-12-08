<?php session_start(); ?>
<!-- ResumeMASTER
	 Lewis Green
	 CPSC 4910
	 XLL755
-->

<!-- This segment of code will create a login 
and create account page for the user. We will connect
this page to a .php file to authenticate the user's information.
May also need ot create another form section to link to account creation.

We will utilize POST method instead of GET because POST is more secure.
Data is not stored via cache, aren't bookmarked, etc. 
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>
        <!-- TODO: this error printing needs prettying -->
        <?php if (isset($_SESSION['err_msg'])) echo $_SESSION['err_msg']; ?>
        <?php unset($_SESSION['err_msg']); ?>
        <form action="../back-end/login-backend.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>



