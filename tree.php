<?php
// Initialize the session
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help A Tree</title>
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

    <div class="form-container">
        <h2>HELP A TREE</h2>
        <form action="submit_form.php" method="post" enctype="multipart/form-data">
            <div class="form-field">
                <label>Upload Picture</label>
                <input type="file" name="picture" required>
            </div>
            <div class="form-field">
                <label>Street <span class="required-star">*</span></label>
                <input type="text" name="street" required>
            </div>
            <div class="form-field">
                <label>Landmark <span class="required-star">*</span></label>
                <input type="text" name="landmark" required>
            </div>
            <div class="form-field">
                <label>Problem <span class="required-star">*</span></label>
                <input type="text" name="problem" required>
            </div>
            <div class="form-field">
                <label for="location_link">Location Link:</label>
                <input type="url" name="location_link" id="location_link" required>
            </div>
            <div class="form-field">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer"></div>

    <script src="scripts.js"></script>
    <script src="header_footer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
