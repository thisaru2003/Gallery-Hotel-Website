<?php
session_start();

include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("SELECT quantity FROM cart_items WHERE user_name = ? AND item_name = ?");
    $stmt->bind_param("ss", $user_name, $item_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        $update_stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE user_name = ? AND item_name = ?");
        $update_stmt->bind_param("iss", $new_quantity, $user_name, $item_name);
        $update_stmt->execute();

        if ($update_stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Cart updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart.']);
        }
    } else {
        $insert_stmt = $conn->prepare("INSERT INTO cart_items (user_name, item_name, quantity, image_url) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("ssis", $user_name, $item_name, $quantity, $image_url);
        $insert_stmt->execute();

        if ($insert_stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Item added to cart successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add item to cart.']);
        }
    }

    $stmt->close();
    $update_stmt->close();
    $insert_stmt->close();
}

$conn->close();
?>
