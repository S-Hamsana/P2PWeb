<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if ($row = mysqli_fetch_assoc($result)) {
  if ($row['password'] === $password) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header("Location: index.php");
  } else {
    echo "Incorrect password";
  }
} else {
  echo "User not found";
}
?>