<?php
include "../back-end/verify-session.php";
include "../back-end/dbfuncs.php";
include "../back-end/User.php";
$mysqli = require_once "../back-end/db-config.php";

$user = new User();
$user->pull($mysqli, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit My Information</title>
        <link href="../css/styles.css" rel="stylesheet">
    </head>
    <body>
       <div class="container">
           <nav>
                <ul class="bar">  <!-- Creating a tab layout on the bar -->
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./my-resumes.php">My Resumes</a></li> <!-- Active tab and "web location" -->
                    <li><a href="./create-resume.php">Create Resume</a></li>
                    <li><a href="./example-resume.php">Example Resume</a></li>
                    <li><a href="./edit-user.php" class="active">Edit My Information</a></li>
                    <li><a href="./logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <h1>Edit My Information</h1>
        <!-- TODO: this error printing needs prettying -->
        <?php if (isset($_SESSION['err_msg'])) echo $_SESSION['err_msg']; ?>
        <?php unset($_SESSION['err_msg']); ?>
        <form action="../back-end/edit-user-backend.php" method="POST">
            <table>
                <tr>
                    <td><label for="userName">User Name</label></td>
                    <td><input type="text" id="userName" name="userName" maxlength="20" value="<?php echo $user->getUserName(); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="firstName">First Name</label></td>
                    <td><input type="text" id="firstName" name="firstName" maxlength="20" value="<?php echo $user->getFirstName(); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="lastName">Last Name</label></td>
                    <td><input type="text" id="lastName" name="lastName" maxlength="20" value="<?php echo $user->getLastName(); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="emailAddr">Email Address</label></td>
                    <td><input type="text" id="emailAddr" name="emailAddr" maxlength="30" value="<?php echo $user->getEmail(); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="passwd_curr">Current Password</label></td>
                    <td><input type="password" id="passwd_curr" name="passwd_curr" maxlength="30" placeholder="Not required"></td>
                    <!-- make not required & add ghost note to that effect -->
                </tr>
                <tr>
                    <td><label for="passwd_new">New Password</label></td>
                    <td><input type="password" id="passwd_new" name="passwd_new" maxlength="30" placeholder="Not required"></td>
                    <!-- make not required & add ghost note to that effect -->
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
