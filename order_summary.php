<?php
session_start();

$orderDetails = $_SESSION['order_details'] ?? null;

if (!$orderDetails) {
    header('Location: menu.php'); 
    exit;
}

$userName = $orderDetails['user_name'];
$userEmail = $orderDetails['email'];
$userPhone = $orderDetails['phone'];
$userAddress = $orderDetails['address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="CSS/odersummery.css">
</head>
<body>

<div class="order-summary">
    <h1>Order #<?php echo $orderDetails['order_id']; ?></h1>
    <p><?php echo date('dS F Y', strtotime($orderDetails['order_date'])) . ' at ' . $orderDetails['order_time']; ?></p>

    <h2>Customer’s Information</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($userName); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($userPhone); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($userAddress); ?></p>

    <h2>Customer’s Cart</h2>
    <div class="cart-items">
        <?php foreach ($orderDetails['cart'] as $item): ?>
            <div class="cart-item">
                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                <p>Price: Rs<?php echo htmlspecialchars($item['price']); ?></p>
                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Summary</h2>
    <p>Total: Rs<?php echo htmlspecialchars($orderDetails['subtotal']); ?></p>

    <h2>Thank you for your order!</h2>

    <a href="menu.php">Pay Later</a>
    <button onclick="paymentGateWay();">Pay here</button>
</div>

<script>
function paymentGateWay() {
    var orderDetails = {
        "order_id": "<?php echo htmlspecialchars($orderDetails['order_id']); ?>",
        "items": "<?php echo implode(', ', array_map(function($item) { 
            return htmlspecialchars($item['name']); 
        }, $orderDetails['cart'])); ?>",
        "amount": "<?php echo htmlspecialchars($orderDetails['subtotal']); ?>",
        "phone": "<?php echo htmlspecialchars($userPhone); ?>",
        "email": "<?php echo htmlspecialchars($userEmail); ?>",
        "address": "<?php echo htmlspecialchars($userAddress); ?>"
    };

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var obj = JSON.parse(xhttp.responseText);

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID: " + orderId);
            };

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID: " + orderId);
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "update_payment_status.php", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var response = JSON.parse(xhttp.responseText);
                        if (response.status === 'success') {
                            console.log(response.message);
                            alert("Payment completed and order status updated successfully.");
                            window.location.href = "menu.php"; 
                        } else {
                            console.log(response.message);
                            alert("Payment completed, but failed to update the database.");
                        }
                    }
                };
                xhttp.send("order_id=" + orderDetails.order_id);
            };

            payhere.onError = function onError(error) {
                console.log("Error: " + error);
            };

            var payment = {
                "sandbox": true,
                "merchant_id": "1228204", 
                "return_url": "http://localhost/pay%20here/", 
                "cancel_url": "http://localhost/pay%20here/", 
                "notify_url": "http://sample.com/notify",
                "order_id": obj["order_id"],
                "items": orderDetails.items,  
                "amount": obj["amount"],
                "currency": obj["currency"],
                "hash": obj["hash"],
                "first_name": obj["first_name"],
                "last_name": obj["last_name"],
                "email": obj["email"],
                "phone": obj["phone"],
                "address": obj["address"],
                "city": obj["city"],
                "country": "Sri Lanka",
                "delivery_address": obj["address"], 
                "delivery_city": obj["city"],
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    }

    xhttp.open("POST", "payherprocess.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(orderDetails)); 
}

</script>

        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>
