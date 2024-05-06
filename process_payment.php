<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$selectedServices = $_SESSION['selected_services'] ?? [];
$totalPrice = $_SESSION['total_price'] ?? 0;
$username = $_SESSION['username'];

// Check for payment form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $street = $_POST['street'];
    $landmark = $_POST['landmark'];
    $problem = $_POST['problem'];
    $locationLink = $_POST['location_link'] ?? '';

    // Handle picture upload
    $allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    $fileType = $_FILES["picture"]["type"];
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0 && in_array($fileType, $allowedTypes)) {
        $uploadDirectory = 'uploads/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }
        $fileName = basename($_FILES["picture"]["name"]);
        $targetFilePath = $uploadDirectory . $fileName;
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
            // Simulate payment processing (replace with real payment gateway integration)
            $paymentSuccessful = true;

            if ($paymentSuccessful) {
                // Connect to the database
                $servername = "localhost";
                $usernameDB = "root";
                $password = "";
                $dbname = "help_a_tree";
                $conn = new mysqli($servername, $usernameDB, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert payment details into `tree_help_requests` table
                $sql = "INSERT INTO tree_help_requests (username, street, landmark, problem, picture, location_link, total_price, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Error preparing statement for tree_help_requests: " . $conn->error);
                }
                $stmt->bind_param("ssssssd", $username, $street, $landmark, $problem, $targetFilePath, $locationLink, $totalPrice);
                $stmt->execute();
                $requestId = $stmt->insert_id;
                $stmt->close();

                // Insert each selected service into `user_services` table
                $sql = "INSERT INTO user_services (payment_id, service_name, service_price) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Error preparing statement for user_services: " . $conn->error);
                }
                foreach ($selectedServices as $service) {
                    $stmt->bind_param("isd", $requestId, $service['name'], $service['price']);
                    $stmt->execute();
                }
                $stmt->close();
                $conn->close();

                // Clear session data after successful payment
                unset($_SESSION['selected_services']);
                unset($_SESSION['total_price']);

                header("Location: payment_success.php");
                exit;
            } else {
                echo "Payment failed. Please try again.";
            }
        } else {
            echo "Error uploading picture.";
        }
    } else {
        echo "Invalid picture type.";
    }
} else {
    header("Location: confirmation_page.php");
    exit;
}
