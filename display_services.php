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

// Fetch services from the database
$sql = "SELECT * FROM tree_services";
$result = $conn->query($sql);
$treeServices = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Tree Services</title>
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
        <h2 class="text-center my-4">Tree Services</h2>
        <form action="handle_selection.php" method="post">
            <div class="row">
                <?php foreach ($treeServices as $service): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($service['service_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($service['service_name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($service['service_name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($service['service_description']); ?></p>
                            <input type="checkbox" class="tree-checkbox" name="tree[]" value="<?php echo htmlspecialchars($service['service_name'] . '|' . $service['service_price']); ?>">
                            <label><?php echo htmlspecialchars($service['service_name']); ?><br><span class="price"><?php echo number_format($service['service_price'], 2) . ' SR'; ?></span></label>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center;">
                <button type="button" id="calculateTotalBtn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; font-size: 16px;">Calculate Total</button>
                <h3>Total: <span id="totalPrice">0.00 SR</span></h3>
                <input type="submit" value="Purchase">
            </div>
        </form>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer"></div>

    <script src="header_footer.js"></script>
    <script>
        function calculateTotal() {
            var total = 0;
            var checkboxes = document.querySelectorAll('.tree-checkbox:checked');
            checkboxes.forEach(function (checkbox) {
                total += parseFloat(checkbox.value.split('|')[1]);
            });
            document.getElementById("totalPrice").innerText = total.toFixed(2) + " SR";
        }
        document.getElementById("calculateTotalBtn").addEventListener("click", calculateTotal);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
