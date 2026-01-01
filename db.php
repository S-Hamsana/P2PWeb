<?php
$servername = "sql303.infinityfree.com";
$username = "if0_39095122";
$password = "Hams2445"; 
$database = "if0_39095122_p2p";



error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
