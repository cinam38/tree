<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "help_a_tree";

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$full_name = $username = $password = $confirm_password = $role = "";
$full_name_err = $username_err = $password_err = $confirm_password_err = $role_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate full name
    $full_name = trim($_POST["full_name"]);
    if (empty($full_name)) {
        $full_name_err = "Please enter your full name.";
    }

    // Validate username
    $username = trim($_POST["username"]);
    if (empty($username)) {
        $username_err = "Please enter a username.";
    }

    // Validate password
    $password = trim($_POST["password"]);
    if (empty($password)) {
        $password_err = "Please enter a password.";     
    } else if (strlen($password) < 6) {
        $password_err = "Password must have at least 6 characters.";
    }

    // Confirm password
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($confirm_password)) {
        $confirm_password_err = "Please confirm your password.";     
    } else if ($password !== $confirm_password) {
        $confirm_password_err = "Password did not match.";
    }

    // Validate role
    $role = trim($_POST["role"]);
    if (empty($role)) {
        $role_err = "Please select a role.";     
    }

    if (empty($full_name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {
        // Insert into appropriate table based on role
        $table = ($role === 'worker') ? "workers" : "helpers";
        $sql = "INSERT INTO $table (full_name, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $full_name, $username, $password_hash);
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: login.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Help Trees</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="lo.png" alt="">
                    <span>tree</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tree.html">help me tree</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search tree.html">search tree</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="main-container">
            <div class="content">
                <h1>WITH YOU WE help trees!</h1>
                <p>Contact us: <br>Email: info@helptrees.com <br>Phone: 123-456-7890</p>
            </div>
            <div class="login-container">
                <h1>Register to Help Trees</h1>
                <div class="button-container">
                    <button type="button" class="toggle-btn" onclick="setRole('worker')">WORKER</button>
                    <button type="button" class="toggle-btn" onclick="setRole('helper')">HELPER</button>
                </div>
                <p id="roleDisplay">Selected role: None</p>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="signup-prompt">
                        have account?? <a href="login.php" class="signup-link">login</a>
                    </div>
                    <input type="hidden" id="role" name="role" required>
                    <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function setRole(role) {
            document.getElementById('role').value = role;
            document.getElementById('roleDisplay').textContent = 'Selected role: ' + role;
        }
    </script>
</body>
</html>
