<?php

$user_input = $_POST["user_input"];
$job_desc = $_POST["job_desc"];
$type = 0;

echo "AI Response: <br><br>";

// arguments currently do not work
$command = escapeshellcmd("python3 resumeMasterAI.py" . " " . $user_input . " " . $job_desc . " " . $type);
$output = shell_exec($command);

// Display the output from Python
echo $output;

?>
