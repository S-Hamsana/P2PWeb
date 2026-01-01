<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT DISTINCT u.id, u.username 
        FROM users u 
        JOIN messages m 
        ON (u.id = m.sender_id AND m.receiver_id = ?) 
        OR (u.id = m.receiver_id AND m.sender_id = ?)
        WHERE u.id != ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Inbox</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>📥 Your Conversations</h2>
  <ul>
    <?php while($row = $result->fetch_assoc()): ?>
      <li><a href="message.php?user=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a></li>
    <?php endwhile; ?>
  </ul>
</body>
</html>
