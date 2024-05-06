<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$selectedServices = $_SESSION['selected_services'] ?? [];
$totalPrice = $_SESSION['total_price'] ?? 0;
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Placeholder -->
    <div id="header"></div>

    <div class="container">
        <h2 class="text-center my-4">Selected Tree Services</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Price (SR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($selectedServices as $service): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['name']); ?></td>
                        <td><?php echo number_format($service['price'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total Price</strong></td>
                        <td><strong><?php echo number_format($totalPrice, 2); ?> SR</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <h2 class="text-center my-4">Payment and Details Confirmation</h2>
        <form action="process_payment.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="card_number" required>
            </div>
            <div class="mb-3">
                <label for="expiryDate" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" id="expiryDate" name="expiry_date" placeholder="MM/YY" required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Upload Picture</label>
                <input type="file" class="form-control" id="picture" name="picture" required>
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Street <span class="required-star">*</span></label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="mb-3">
                <label for="landmark" class="form-label">Landmark <span class="required-star">*</span></label>
                <input type="text" class="form-control" id="landmark" name="landmark" required>
            </div>
            <div class="mb-3">
                <label for="problem" class="form-label">Problem <span class="required-star">*</span></label>
                <input type="text" class="form-control" id="problem" name="problem" required>
            </div>
            <div class="mb-3">
                <label for="locationLink" class="form-label">Location Link</label>
                <input type="url" class="form-control" id="locationLink" name="location_link">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Confirm Payment">
            </div>
        </form>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer"></div>

    <script src="header_footer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
