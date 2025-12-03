<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders - The Gallery Café</title>
    <link rel="icon" type="image" href="Images/Icon.png">
    <link rel="stylesheet" href="CSS/staff_orders.css">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['user_role'])) {
    switch ($_SESSION['user_role']) {
        case 'admin':
            include 'adminheader.php';
            break;
        case 'staff':
            include 'staffheader.php';
            break;
        case 'users':
            include 'header.php'; 
            break;
        default:
            include 'header.php'; 
            break;
    }
} else {
    include 'header.php';
}
?> 

<div class="Mtext"><b>Your Orders</b></div>
    <div class="container">
        <table id="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered Items</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Dine/Takeaway</th>
                    <th>Payment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('db.php');


                $logged_in_user = $_SESSION['username']; 
                $query = "
                    SELECT o.id AS order_id, 
                           GROUP_CONCAT(CONCAT(oi.item_name, ' (', oi.quantity, ')') ORDER BY oi.item_name SEPARATOR ', ') AS ordered_items,
                           SUM(oi.quantity) AS total_quantity,
                           SUM(oi.price * oi.quantity) AS total_price,
                           o.order_date, o.order_time, o.dine_takeaway,o.payment, o.status
                    FROM orders o
                    JOIN order_items oi ON o.id = oi.order_id
                    WHERE o.user_name = '$logged_in_user'
                    GROUP BY o.id
                ";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['ordered_items']}</td>";
                        echo "<td>{$row['total_quantity']}</td>";
                        echo "<td>{$row['total_price']}</td>";
                        echo "<td>{$row['order_date']}</td>";
                        echo "<td>{$row['order_time']}</td>";
                        echo "<td>{$row['dine_takeaway']}</td>";
                        echo "<td>{$row['payment']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <a href="UserDashboard.php" class="back-btn">Back</a>

</body>
</html>
