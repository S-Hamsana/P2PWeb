<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$title = $_POST['title'];
$desc = $_POST['description'];
$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO courses (title, description, teacher_id) VALUES ('$title', '$desc', '$user_id')";

if (mysqli_query($conn, $sql)) {
  header("Location: courses.php");
} else {
  echo "Failed to post course: " . mysqli_error($conn);
}
?>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$title = $_POST['title'];
$desc = $_POST['description'];
$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO courses (title, description, teacher_id) VALUES ('$title', '$desc', '$user_id')";

if (mysqli_query($conn, $sql)) {
  header("Location: courses.php");
} else {
  echo "Failed to post course: " . mysqli_error($conn);
}
?>
