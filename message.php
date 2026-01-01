<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['user'])) {
    header("Location: login.html");
    exit();
}

$my_id = $_SESSION['user_id'];
$other_id = (int)$_GET['user'];


$user_sql = $conn->prepare("SELECT username FROM users WHERE id = ?");
$user_sql->bind_param("i", $other_id);
$user_sql->execute();
$user_result = $user_sql->get_result()->fetch_assoc();
$other_name = $user_result['username'] ?? "Unknown";


$sql = "SELECT * FROM messages 
        WHERE (sender_id = ? AND receiver_id = ?) 
           OR (sender_id = ? AND receiver_id = ?) 
        ORDER BY sent_at ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $my_id, $other_id, $other_id, $my_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chat with <?= htmlspecialchars($other_name) ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>💬 Chat with <?= htmlspecialchars($other_name) ?></h2>
  <div style="border:1px solid #ccc; padding:10px; max-height:400px; overflow-y:scroll;">
    <?php while($msg = $result->fetch_assoc()): ?>
      <p style="text-align: <?= $msg['sender_id'] == $my_id ? 'right' : 'left' ?>;">
        <strong><?= $msg['sender_id'] == $my_id ? 'You' : $other_name ?>:</strong> 
        <?= nl2br(htmlspecialchars($msg['content'])) ?>
        <br><small><em><?= $msg['sent_at'] ?></em></small>
      </p>
    <?php endwhile; ?>
  </div>

  <form action="send_message.php" method="post" style="margin-top:10px;">
    <input type="hidden" name="to" value="<?= $other_id ?>">
    <textarea name="content" rows="3" cols="50" placeholder="Type your message..." required></textarea><br>
    <button type="submit">Send</button>
  </form>
  <p><a href="inbox.php">⬅ Back to Inbox</a></p>
</body>
</html>
