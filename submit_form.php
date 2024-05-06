<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_a_tree";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/gif");
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
                if ($stmt = $conn->prepare($sql)) {
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
