<?php
include 'check_login.php'; 
?>
<!-- resumePage.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Resume</title>
    <style>
        /* Base reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Centering content and background styling */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f7f9fc;
            padding: 2em;
            min-height: 100vh;
        }

        /* Page header styling */
        h1 {
            text-align: center;
            color: #C70039;
            margin-bottom: 1em;
            font-size: 1.8em;
        }

        /* Form container styling */
        .form-container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Table layout for form fields */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Label and input field styling */
        label {
            display: inline-block;
            font-size: 0.9em;
            color: #555;
            margin-bottom: 0.5em;
        }

        input[type="file"] {
            width: 100%;
            padding: 0.75em;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 1em;
            font-size: 0.9em;
        }

        /* Submit button styling */
        input[type="submit"], .back-button {
            width: calc(50% - 10px);
            padding: 0.75em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        /* Hover effect for buttons */
        input[type="submit"]:hover, .back-button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <h1>Upload Your Resume</h1>
    <div class="form-container">
        
        <form action="resumePage_Backend.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="resume">Upload Resume (PDF only):</label></td>
                </tr>
                <tr>
                    <td><input type="file" id="resume" name="resume" accept=".pdf" required></td>
                </tr>
                <tr>
                    <td>
					<input type="submit" value="Upload"><a href="uHome.php" class="back-button">Back</a>
					</td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>


