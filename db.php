<?php
// Database connection configuration

// Define the server name where the MySQL database is hosted
$servername = "localhost"; // 'localhost' means the database is on the same server as the PHP code

// Define the username for MySQL
$username = "root"; // 'root' is the default username for MySQL

// Define the password for MySQL
$password = ""; // Default password is empty in most local installations of MySQL

// Define the name of the database to connect to
$dbname = "user_system"; // Name of the database where the user data is stored

// Create a connection to the database using the `mysqli` class
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there's an error, terminate the script and display an error message
    die("Connection failed: " . $conn->connect_error);
}

// If the script reaches this point, the database connection is successful
?>

