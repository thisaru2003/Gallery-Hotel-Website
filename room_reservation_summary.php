<?php
session_start();

$reservationDetails = $_SESSION['reservation_details'] ?? null;

if (!$reservationDetails || !isset($reservationDetails['id'])) {
    header('Location: RoomReservation.php'); 
    exit;
}

$reservationID = $reservationDetails['id'];
$userName = $reservationDetails['user_name'];
$userEmail = $reservationDetails['email'];
$userPhone = $reservationDetails['phone'];
$userAddress = $reservationDetails['address'];
$reservationDate = $reservationDetails['reservation_date'];
$reservationTime = $reservationDetails['reservation_time'];
$roomName = $reservationDetails['room_name'];
$guests = $reservationDetails['number_of_guests'];
$duration = $reservationDetails['duration'];
$totalPrice = $reservationDetails['total_price'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Summary</title>
    <link rel="stylesheet" href="CSS/odersummery.css">
</head>
<body>

<div class="order-summary">
    <h1>Reservation for Room: <?php echo htmlspecialchars($roomName); ?></h1>
    <p>Date: <?php echo date('dS F Y', strtotime($reservationDate)); ?> at <?php echo htmlspecialchars($reservationTime); ?></p>

    <h2>Customer’s Information</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($userName); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($userPhone); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($userAddress); ?></p>

    <h2>Reservation Details</h2>
    <p><strong>Number of Guests:</strong> <?php echo htmlspecialchars($guests); ?></p>
    <p><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?> days</p>
    <p><strong>Total Price:</strong> GBP.<?php echo htmlspecialchars(number_format($totalPrice, 2)); ?></p>

    <h2>Thank you for reserving with us!</h2>

    <a href="RoomReservation.php">Make another reservation</a>
    <button onclick="paymentGateWay();">Pay here</button>
</div>

<script>
function paymentGateWay() {
    var reservationDetails = {
        "reservation_id": "<?php echo htmlspecialchars($reservationID); ?>",
        "items": "<?php echo htmlspecialchars($roomName); ?>",
        "amount": "<?php echo htmlspecialchars($totalPrice); ?>",
        "phone": "<?php echo htmlspecialchars($userPhone); ?>",
        "email": "<?php echo htmlspecialchars($userEmail); ?>",
        "address": "<?php echo htmlspecialchars($userAddress); ?>"
    };

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var response = JSON.parse(xhttp.responseText);

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. ReservationID: " + reservationDetails.reservation_id);
            };

            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
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
                "order_id": response.reservation_id,
                "items": reservationDetails.items,
                "amount": response.amount,
                "currency": response.currency,
                "hash": response.hash,
                "first_name": response.first_name,
                "last_name": response.last_name,
                "email": response.email,
                "phone": response.phone,
                "address": response.address,
                "city": response.city,
                "country": "United Kingdom",
                "delivery_address": response.address, 
                "delivery_city": response.city,
                "delivery_country": "United Kingdom",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    };

    xhttp.open("POST", "payherprocess2.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(reservationDetails));
}
</script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>
</html>
