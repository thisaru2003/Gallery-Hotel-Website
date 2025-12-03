<?php
session_start(); 

include('db.php');


if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_name = $_SESSION['username'];

$order_date = $_POST['order_date'] ?? '';
$order_time = $_POST['order_time'] ?? '';
$cart = json_decode($_POST['cart'], true); 

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO orders (user_name, order_date, order_time) VALUES (?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $user_name, $order_date, $order_time);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    foreach ($cart as $item) {
        $stmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_name = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $user_name);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    $stmt->close();

    $conn->commit();

    echo json_encode(['status' => 'success', 'order_id' => $order_id]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conn->close();
?>
