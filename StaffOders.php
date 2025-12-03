<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
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
            header("Location: login.php");
            exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<div class="Mtext"><b>Manage Orders</b></div>
    <div class="container">
        <table id="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Ordered Items</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Dine/Takeaway</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "gallery_cafe");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "
                    SELECT o.id AS order_id, o.user_name, 
                           GROUP_CONCAT(CONCAT(oi.item_name, ' (', oi.quantity, ')') ORDER BY oi.item_name SEPARATOR ', ') AS ordered_items,
                           SUM(oi.quantity) AS total_quantity,
                           SUM(oi.price * oi.quantity) AS total_price,
                           o.order_date, o.order_time, o.dine_takeaway, o.payment, o.status
                    FROM orders o
                    JOIN order_items oi ON o.id = oi.order_id
                    GROUP BY o.id
                ";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['order_id']}</td>";
                    echo "<td>{$row['user_name']}</td>";
                    echo "<td>{$row['ordered_items']}</td>";
                    echo "<td>{$row['total_quantity']}</td>";
                    echo "<td>{$row['total_price']}</td>";
                    echo "<td>{$row['order_date']}</td>";
                    echo "<td>{$row['order_time']}</td>";
                    echo "<td>{$row['dine_takeaway']}</td>";
                    echo "<td>{$row['payment']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>
                            <button onclick=\"updateOrderStatus({$row['order_id']}, 'Confirmed')\" class='confirm'>Confirm</button>
                            <button onclick=\"updateOrderStatus({$row['order_id']}, 'Declined')\" class='decline'>Decline</button>
                          </td>";
                    echo "<td><a href='Staffbill.php?order_id={$row['order_id']}' class='print'>PrintBill</a></td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="JS/stafforders.js"></script>
</body>
</html>
