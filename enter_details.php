<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect user to login page if not logged in
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enter Details</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Ensure you have a CSS file for styles -->
</head>
<body>
    <h1>Enter Your Details</h1>
    <form action="submit_order.php" method="post" style="text-align: center;">
        <!-- Customer Address Details -->
        <div class="form-field">
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" required>
        </div>

        <div class="form-field">
            <label for="location_link">Website/Location Link:</label>
            <input type="url" id="location_link" name="location_link">
        </div>

        <div class="form-field">
            <label for="landmark">Landmark:</label>
            <input type="text" id="landmark" name="landmark">
        </div>

        <input type="submit" value="Submit Order">
    </form>
</body>
</html>
