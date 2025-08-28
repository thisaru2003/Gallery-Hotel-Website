<?php

session_start();
include('db.php');

$user_name = $_SESSION['username']; 

$sql = "SELECT c.item_id, c.quantity, c.price, m.name, m.image_url 
        FROM cart_items c 
        JOIN menu_items m ON c.item_id = m.id 
        WHERE c.user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode(['cartItems' => $cartItems]);

$conn->close();
?>
