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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $dine_takeaway = $_POST['dine_takeaway'];
    $username = $_POST['username'];
    $cart = json_decode($_POST['cart'], true);

    $stmt = $conn->prepare("INSERT INTO orders (full_name, email, address, contact_number, dine_takeaway, username) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $email, $address, $contact_number, $dine_takeaway, $username);
    $stmt->execute();
    $order_id = $stmt->insert_id; 
    $stmt->close();

    foreach ($cart as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
        $stmt->execute();
        $stmt->close();
    }

    $payment_url = "https://sandbox.payhere.lk/pay/checkout"; 
    $payhere_data = [
        'merchant_id' => '1228204',
        'order_id' => $order_id,
        'currency' => 'LKR',
        'amount' => array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart)),
        'first_name' => $full_name,
        'last_name' => '',
        'email' => $email,
        'phone' => $contact_number,
        'address' => $address,
        'city' => '',
        'country' => 'Sri Lanka',
        'return_url' => 'YOUR_RETURN_URL', 
        'cancel_url' => 'YOUR_CANCEL_URL',
        'status_url' => 'YOUR_STATUS_URL'
    ];

    $payment_url .= '?' . http_build_query($payhere_data);

    echo json_encode(['status' => 'success', 'payment_url' => $payment_url]);
}
?>
