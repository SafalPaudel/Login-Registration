<?php
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = "";     // Default MySQL password
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

