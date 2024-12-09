<?php session_start(); ?>
<!-- ResumeMASTER
	 Lewis Green
	 CPSC 4910
	 XLL755
-->
<!-- 
	This webpage will be used for account creation.
	This webpage will accept the users first name, last name,
	and their email address. It will then be stored so the users
	can then login in on the login page once completed.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>

    <div class="creation-container">
        <h1>Create Account</h1>
        <?php if (isset($_SESSION['err_msg'])) echo $_SESSION['err_msg']; ?>
        <?php unset($_SESSION['err_msg']); ?>
        <form action="../back-end/create-account-backend.php" method="POST">
            <table>
                <tr>
                    <td><label for="userName">User Name</label></td>
                    <td><input type="text" id="userName" name="userName" maxlength="20" required></td>
                </tr>
                <tr>
                    <td><label for="firstName">First Name</label></td>
                    <td><input type="text" id="firstName" name="firstName" maxlength="20" required></td>
                </tr>
                <tr>
                    <td><label for="lastName">Last Name</label></td>
                    <td><input type="text" id="lastName" name="lastName" maxlength="20" required></td>
                </tr>
                <tr>
                    <td><label for="emailAddr">Email Address</label></td>
                    <td><input type="text" id="emailAddr" name="emailAddr" maxlength="30" required></td>
                </tr>
                <tr>
                    <td><label for="passwd">Password</label></td>
                    <td><input type="password" id="passwd" name="passwd" maxlength="30" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>





