<?php

$user_input = $_POST["user_input"];
$job_desc = $_POST["job_desc"];
$type = $_POST["section"];

echo "AI Response: <br><br>";

$command = "/app/.venv/bin/python3 /var/www/html/resumeMasterAI.py " . escapeshellarg($user_input) . " " . escapeshellarg($job_desc) . " " . escapeshellarg($type);
$output = shell_exec($command);

// Display the output from Python
echo $output;

?>
