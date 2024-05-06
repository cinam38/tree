
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome</title>

    <link rel="stylesheet" href="styles.css">
    <script>

    </script>
        <link rel="stylesheet" href="css/style.css">

    <!-- Bootstra CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    	<!-- ================Header Start================ -->
	<header>
		<!-- Navigation Start -->
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
							<a class="nav-link" href="tree.html">help me tree</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="about.php">About Us</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="search tree.php">search tree</a>
						</li>
					</ul>

					<form class="d-flex">
						<a class="login-btn" href="login.html">Login</a>
					</form>
				</div>
			</div>
		</nav>
		<!-- Navigation End -->
	</header>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once "config.php"; // Database connection settings

$role = $_SESSION['role'];
$username = $_SESSION['username'];

// Query based on role
if ($role === 'helper') {
    $sql = "SELECT * FROM tree_help_requests";
} else {
    $sql = "SELECT * FROM tree_help_requests WHERE username = ?";
}

$stmt = $conn->prepare($sql);
if ($role !== 'helper') {
    $stmt->bind_param("s", $username);
}
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Tree Help Requests</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Street</th><th>Landmark</th><th>Problem</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['street'] . "</td>";
    echo "<td>" . $row['landmark'] . "</td>";
    echo "<td>" . $row['problem'] . "</td>";
    echo "<td>";
    echo "<a href='edit_request.php?id=" . $row['id'] . "'>Edit</a>";
    echo " | ";
    echo "<a href='delete_request.php?id=" . $row['id'] . "'>Delete</a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

$stmt->close();
$conn->close();
?>
