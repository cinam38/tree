<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and update the record
    $id = $_POST['id'];
    $street = $_POST['street'];
    $landmark = $_POST['landmark'];
    $problem = $_POST['problem'];

    $sql = "UPDATE tree_help_requests SET street = ?, landmark = ?, problem = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $street, $landmark, $problem, $id);
    if ($stmt->execute()) {
        header("Location: display_requests.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
    // Display the form with existing data
    $id = $_GET['id'];
    $sql = "SELECT * FROM tree_help_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    $street = $data['street'];
    $landmark = $data['landmark'];
    $problem = $data['problem'];
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>
        <label>Street:</label>
        <input type="text" name="street" value="<?php echo $street; ?>">
    </p>
    <p>
        <label>Landmark:</label>
        <input type="text" name="landmark" value="<?php echo $landmark; ?>">
    </p>
    <p>
        <label>Problem:</label>
        <input type="text" name="problem" value="<?php echo $problem; ?>">
    </p>
    <input type="submit" value="Update">
</form>
