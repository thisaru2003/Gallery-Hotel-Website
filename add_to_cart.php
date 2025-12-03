<?php
session_start();

include('db.php');

if (!isset($_SESSION['user_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_name = $_SESSION['user_name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    $stmt_check = $conn->prepare("SELECT * FROM cart_items WHERE user_name = ? AND item_name = ?");
    $stmt_check->bind_param("ss", $user_name, $item_name);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $stmt_update = $conn->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE user_name = ? AND item_name = ?");
        $stmt_update->bind_param("iss", $quantity, $user_name, $item_name);
        if ($stmt_update->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Cart updated']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $stmt_update->error]);
        }
        $stmt_update->close();
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO cart_items (user_name, item_name, quantity, price, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("ssids", $user_name, $item_name, $quantity, $price, $image_url);
        if ($stmt_insert->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $stmt_insert->error]);
        }
        $stmt_insert->close();
    }

    $stmt_check->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
