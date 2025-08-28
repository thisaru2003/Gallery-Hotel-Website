<?php
$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if (isset($_POST['order_id']) && is_numeric($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    
    $sql_update = "UPDATE orders SET payment = 'Complete' WHERE id = $order_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Payment status updated successfully.";
    } else {
        echo "Error updating payment status: " . $conn->error;
    }
} else {
    echo "Invalid order ID provided.";
}

$conn->close();
?>
