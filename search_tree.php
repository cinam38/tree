<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_a_tree";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {
    $query = $conn->real_escape_string($_GET["query"]);
    $sql = "SELECT * FROM tree_help_requests WHERE street LIKE ? OR landmark LIKE ? OR problem LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeQuery = "%$query%";
    $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tree</title>
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
    <!-- Header Placeholder -->
    <div id="header"></div>

    <div class="container">
        <h2>Search Tree Requests</h2>
        <form action="search_tree.php" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter search term" name="query" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button class="btn btn-success" type="submit">Search</button>
            </div>
        </form>

        <?php if (!empty($searchResults)): ?>
            <h3>Search Results:</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Street</th>
                            <th>Landmark</th>
                            <th>Problem</th>
                            <th>Picture</th>
                            <th>Location Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $result): ?>
                        <tr>
                            <td><?php echo $result['id']; ?></td>
                            <td><?php echo htmlspecialchars($result['street']); ?></td>
                            <td><?php echo htmlspecialchars($result['landmark']); ?></td>
                            <td><?php echo htmlspecialchars($result['problem']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($result['picture']); ?>" alt="Tree Image" width="100"></td>
                            <td><a href="<?php echo htmlspecialchars($result['location_link']); ?>" target="_blank">Location Link</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <?php if (isset($_GET['query'])): ?>
                <p>No results found for "<?php echo htmlspecialchars($_GET['query']); ?>".</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer"></div>

    <script src="header_footer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
