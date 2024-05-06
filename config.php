<?php
// Database credentials
$servername = "localhost";
$username = "root";    // The default username for MySQL
$password = "";        // Default password for MySQL (empty for XAMPP)
$dbname = "help_a_tree";  // Your database name

// Create a new MySQLi connection object
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you could enable UTF-8 encoding and collation which is recommended for multilingual data
$conn->set_charset("utf8mb4");

// Keep the connection open for further use in your scripts
?>
