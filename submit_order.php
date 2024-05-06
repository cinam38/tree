<?php
session_start(); // Start the session

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Database credentials and connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_a_tree";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS tree_help_requests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255) NOT NULL,
    landmark VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    problem TEXT NOT NULL,
    picture VARCHAR(255),
    location_link VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute table creation query
if (!$conn->query($sql)) {
    die("Error creating table: " . $conn->error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $fileType = $_FILES["picture"]["type"];
        if (in_array($fileType, $allowedTypes)) {
            $uploadDirectory = 'uploads/';
            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $fileName = basename($_FILES["picture"]["name"]);
            $targetFilePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
                $street = $conn->real_escape_string($_POST['street']);
                $landmark = $conn->real_escape_string($_POST['landmark']);
                $problem = $conn->real_escape_string($_POST['problem']);
                $locationLink = $conn->real_escape_string($_POST['location_link']);

                $sql = "INSERT INTO tree_help_requests (username, street, landmark, problem, picture, location_link) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ssssss", $_SESSION['username'], $street, $landmark, $problem, $targetFilePath, $locationLink);
                    if ($stmt->execute()) {
                        header('Location: thank_you.php');
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                }
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "Error: Only .jpg, .jpeg, .png, and .gif files are allowed.";
        }
    } else {
        echo "Error: " . $_FILES["picture"]["error"];
    }
}

$conn->close();
?>
