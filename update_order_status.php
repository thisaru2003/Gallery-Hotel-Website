<?php
include('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id=$order_id";

    if ($conn->query($sql) === TRUE) {
        echo "Order status updated successfully";
    } else {
        echo "Error updating order status: " . $conn->error;
    }
}

$conn->close();
?>
