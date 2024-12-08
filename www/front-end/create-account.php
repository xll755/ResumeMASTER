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
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Full-page background */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #fff7ea;
        }

        /* Centered container */
        .container {
            width: 100%;
            max-width: 400px;
            padding: 2em;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Title styling */
        h1 {
            text-align: center;
            margin-bottom: 1em;
            font-size: 1.8em;
            color: #333;
        }

        /* Form table styling */
        table {
            width: 100%;
        }

        /* Label and input field styling */
        label {
            display: block;
            font-size: 0.9em;
            color: #555;
            margin-bottom: 0.3em;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.75em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            color: #333;
        }

        /* Submit button styling */
        input[type="submit"] {
            width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 4px;
            background-color: #9f8c6c;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Hover effect for submit button */
        input[type="submit"]:hover {
            background-color: #5f5441;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Create Account</h1>
        <!-- TODO: this error printing needs prettying -->
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





