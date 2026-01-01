<?php session_start(); ?>
<?php if (!isset($_SESSION['user_id'])) { header("Location: login.html"); exit(); } ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Course</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Add a New Course</h2>
  <form action="submit_course.php" method="POST">
    <input type="text" name="title" placeholder="Course Title" required><br>
    <textarea name="description" placeholder="Course Description" required></textarea><br>
    <button type="submit">Post Course</button>
  </form>
</body>
</html>
