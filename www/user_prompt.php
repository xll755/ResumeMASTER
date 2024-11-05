<?php
session_start();
?>
<html>

<body>

  <form action="apiscript_caller.php" method="POST">

    Resume Section: <br>
    <select name="section">
      <option value="objective">Objective/Summary</option>
      <option value="work_experience">Work Experience</option>
      <option value="education">Education</option>
      <option value="skills">Skills</option>
    </select>

    <br><br>

    User Input: <br>
    <textarea type="text" name="user_input" rows="10" cols="80"></textarea><br>

    <br><br>

    Job Description: <br>
    <textarea type="text" name="job_desc" rows="10" cols="80"></textarea><br>

    <br><br>

    <input type="submit">
  </form>

</body>

</html>
