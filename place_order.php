<?php
session_start();

include('db.php');


$user_name = $_POST['user_name'];
$cart = json_decode($_POST['cart'], true);

if (!$user_name || empty($cart)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    exit();
}

$query = "DELETE FROM cart_items WHERE user_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $user_name);
$stmt->execute();

$query = "INSERT INTO cart_items (user_name, item_name, quantity, price, image_url) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);

foreach ($cart as $item) {
    $stmt->bind_param('ssids', $user_name, $item['name'], $item['quantity'], $item['price'], $item['image_url']);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(['status' => 'success']);
?>
