<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Peer 2 Peer</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <nav class="top-nav">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="courses.php">Courses</a></li>

      <?php if (isset($_SESSION['username'])): ?>
        <li><a href="add_course.php">Add Course</a></li>
        <li><a href="inbox.php">Inbox</a></li>
        <li>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></li>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="register.html">Register</a></li>
        <li><a href="login.html">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <section class="hero">
    <h1>Welcome to Peer 2 Peer</h1>
    <p>Skill sharing made simple</p>
  </section>

</body>
</html>
