<?php
// Start the session
session_start();

// Database credentials
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "help_a_tree";

// Create connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$username = $password = $role = "";
$username_err = $password_err = $role_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if role is selected
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please select a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err) && empty($role_err)) {
        // Select statement based on role
        $table = ($role === 'worker') ? "workers" : "helpers";
        $sql = "SELECT id, username, password FROM $table WHERE username = ?";

        if ($stmt = $db->prepare($sql)) {
            // Bind variables to prepared statement
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            // Execute statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $fetched_username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_regenerate_id();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $fetched_username;
                            $_SESSION["role"] = $role;

                            header("location: index.php");
                        } else {
                            $password_err = "Invalid password.";
                        }
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Close connection
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Help Trees</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Start -->
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tree.html">Help Me Tree</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search_tree.html">Search Tree</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="login-btn" href="register.php">Register</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header End -->

    <div class="container">
        <div class="main-container">
            <div class="content">
                <h1>WITH YOU WE Help Trees!</h1>
                <p>Contact us:<br>Email: info@helptrees.com<br>Phone: 123-456-7890</p>
            </div>
            <div class="login-container">
                <h1>Login to Help Trees</h1>
                <div class="button-container">
                    <button type="button" id="workerBtn" class="toggle-btn" onclick="setRole('worker')">WORKER</button>
                    <button type="button" id="helperBtn" class="toggle-btn" onclick="setRole('helper')">HELPER</button>
                </div>
                <p id="roleDisplay">Selected role: None</p>
                <form id="loginForm" action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                        <?php if (!empty($username_err)) echo "<p class='text-danger'>$username_err</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <?php if (!empty($password_err)) echo "<p class='text-danger'>$password_err</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="hidden" id="role" name="role" required>
                        <?php if (!empty($role_err)) echo "<p class='text-danger'>$role_err</p>"; ?>
                    </div>
                    <div class="signup-prompt">
                        Not registered? <a href="register.php" class="signup-link">Sign Up</a>
                    </div>
                    <button type="submit" class="submit-btn">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <footer>
        <div class="footer-bottom">
            <p>Contact us: <a href="mailto:info@helptrees.com">info@helptrees.com</a> | Phone: 123-456-7890</p>
            <div class="footer-bottom-list">
                <a href="#">About Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <script>
        function setRole(role) {
            document.getElementById('role').value = role;
            document.getElementById('roleDisplay').textContent = 'Selected role: ' + role;
        }
    </script>
    <script src="scripts.js"></script>
</body>
</html>
