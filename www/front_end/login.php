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
    <title>Login Page</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Full page background */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #fff7ea;
        }

        /* Centered container */
        .container {
            width: 300px;
            padding: 2em;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        /* Title styling */
        h2 {
            margin-bottom: 1em;
            font-size: 1.5em;
            color: #333;
        }

        /* Input fields */
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

        /* Button styling */
        button[type="submit"] {
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
/* Submit button styling */
        input[type="submit"], .back-button {
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
        /* Button hover effect */
        button[type="submit"]:hover {
            background-color: #5f5441;
        }

        /* Placeholder text */
        input::placeholder {
            color: #999;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Login</h2>
        <!-- TODO: this error printing needs prettying -->
        <?php if (isset($_SESSION['err_msg'])) echo $_SESSION['err_msg']; ?>
        <?php unset($_SESSION['err_msg']); ?>
        <form action="../back_end/login-backend.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>



