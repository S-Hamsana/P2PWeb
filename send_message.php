<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}


$from = $_SESSION['user_id'];
$to = $_POST['to'] ?? null;
$content = $_POST['content'] ?? '';

if (!$to || !$content) {
    echo "Invalid data provided. <a href='courses.php'>Go Back</a>";
    exit();
}

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $from, $to, $content);

if ($stmt->execute()) {
    echo "Message sent! <a href='courses.php'>Go Back</a>";
} else {
    echo "Failed to send message: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
