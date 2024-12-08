<?php
include "../back-end/verify-session.php";
$mysqli = require_once "../back-end/db-config.php";
include "../back-end/dbfuncs.php";
include "../back-end/Resume.php";

$query = "select resumes.id, resumes.name from resumes where resumes.userId = (?)";
$stmt = $mysqli->prepare($query);
$user_id = $_SESSION['user_id'];
$types = "i";
$stmt->bind_param($types, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$resumes = $result->fetch_all();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $_SESSION['resume_id'] = $_GET['id'];
    switch($_GET['action']) {
        case 'view':
            $_SESSION['from_my'] = true;
            header("Location: ./view-resume.php");
            exit;
        case 'edit':
            $_SESSION['from_my'] = true;
            header("Location: ./create-resume.php");
            exit;
        case 'download':
            header("Location: ../back-end/resume-download.php");
            exit;
        case 'delete':
            $resume = new Resume();
            $resume->delete($mysqli, $_GET['id']);
            header("Location: ./my-resumes.php");
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Resumes</title>
    </head>
    <body>
       <div class="container">
       <link rel="stylesheet" href="../css/styles.css">
           <nav>
                <ul class="bar">  <!-- Creating a tab layout on the bar -->
                    <li><a href="./home.php">Home</a></li> 
                    <li><a href="./my-resumes.php" class="active">My Resumes</a></li> <!-- Active tab and "web location" -->
                    <li><a href="./create-resume.php">Create Resume</a></li>
                    <li><a href="./example-resume.php">Example Resume</a></li>
                    <!-- <li><a href="comparisonF.php">Qualification Comparison</a></li> -->
                    <li><a href="./logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <h1>My Resumes</h1>
        <?php if (sizeof($resumes) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resumes as $r): ?>
                <tr>
                    <td><?php echo $r[0]; ?></td>
                    <td><?php echo $r[1]; ?></td>
                    <td><a href="?action=view&id=<?php echo $r[0];?>">View</a></td>
                    <td><a href="?action=edit&id=<?php echo $r[0];?>">Edit</a></td>
                    <td><a href="?action=download&id=<?php echo $r[0];?>">Download</a></td>
                    <td><a href="?action=delete&id=<?php echo $r[0];?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
        <h3>You currently don't have any resumes created. <a href="./create-resume.php">Create one?</a></h3>
        <?php endif; ?>
    </body>
</html>
