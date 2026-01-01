<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$result = mysqli_query($conn, "SELECT c.*, u.username FROM courses c JOIN users u ON c.teacher_id = u.id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Courses</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>All Available Courses</h2>
  <a href="add_course.php">+ Add Your Own Course</a> |
  <a href="inbox.php">📥 Inbox</a> |
  <a href="logout.php">🚪 Logout</a>
  <br><br>

  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px">
      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
      <p><b>By:</b> <?= htmlspecialchars($row['username']) ?></p>
      <a href="message.php?user=<?= $row['teacher_id'] ?>">Send Message</a>
    </div>
  <?php endwhile; ?>
</body>
</html>
