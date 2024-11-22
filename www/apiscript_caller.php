<?php

$user_input = $_POST["user_input"];
$job_desc = $_POST["job_desc"];
$type = 0;

echo "AI Response: <br><br>";

// call does not work? the genai lib is installed in a virtual env, hence the
// first part of the call, however it doesnt seem to be running?
$command = escapeshellcmd("/app/.venv/bin/python3 ./resumeMasterAI.py" . " " . $user_input . " " . $job_desc . " " . $type);
$output = shell_exec($command);

// Display the output from Python
echo $output;

?>
