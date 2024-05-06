<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tree'])) {
    $selectedServices = [];
    $totalPrice = 0;

    foreach ($_POST['tree'] as $service) {
        list($serviceName, $servicePrice) = explode('|', $service);
        $totalPrice += (float)$servicePrice;
        $selectedServices[] = [
            'name' => $serviceName,
            'price' => $servicePrice
        ];
    }

    $_SESSION['selected_services'] = $selectedServices;
    $_SESSION['total_price'] = $totalPrice;

    header('Location: confirmation_page.php');
    exit;
} else {
    echo "Please select at least one service.";
}
?>
