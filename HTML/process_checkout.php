<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_name = $_SESSION['username'];

$user_email = $user_phone = $user_address = null;

$tables = ['staff', 'users', 'admin'];
foreach ($tables as $table) {
    $stmt = $conn->prepare("SELECT email, phone, address FROM $table WHERE username = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_email, $user_phone, $user_address);
    $stmt->fetch();
    $stmt->close();

    if ($user_email && $user_phone && $user_address) {
        break;
    }
}

if (!$user_email || !$user_phone || !$user_address) {
    echo json_encode(['status' => 'error', 'message' => 'User details not found.']);
    exit;
}

$dine_takeaway = $_POST['dine_takeaway'] ?? '';
$order_date = $_POST['order_date'] ?? '';
$order_time = $_POST['order_time'] ?? '';
$cart = json_decode($_POST['cart'], true); 

error_log("Dine Takeaway: $dine_takeaway");
error_log("Order Date: $order_date");
error_log("Order Time: $order_time");
error_log("User Name: $user_name");
error_log("Cart: " . print_r($cart, true));

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO orders (user_name, dine_takeaway, order_date, order_time) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssss", $user_name, $dine_takeaway, $order_date, $order_time);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $subtotal = 0;
    $order_items = []; 

    foreach ($cart as $item) {
        $stmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $subtotal += $item['price'] * $item['quantity'];
        $order_items[] = [
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'image_url' => $item['image_url'] 
        ];
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

    $_SESSION['order_details'] = [
        'order_id' => $order_id,
        'order_date' => $order_date,
        'order_time' => $order_time,
        'subtotal' => $subtotal,
        'cart' => $order_items,
        'user_name' => $user_name,   
        'email' => $user_email,    
        'phone' => $user_phone,    
        'address' => $user_address   
    ];

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    $conn->rollback();

    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conn->close();
?>
