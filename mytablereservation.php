<?php
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$user_name = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Table Reservations - The Gallery Café</title>
    <link rel="icon" type="image" href="Images/Icon.png">
    <link rel="stylesheet" href="CSS/staff_orders.css">
</head>
<body>
<?php
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

<div class="Mtext"><b>My Table Reservations</b></div>
    <div class="container">

        <table id="reservations-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>User Name</th>
                    <th>Table Name</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Guests</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="reservation-table-body">
                <?php
                include('db.php');


                $query = "SELECT * FROM reservations WHERE user_name = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $user_name);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $statusClass = strtolower($row['status']);
                    echo "<tr>";
                    echo "<td>{$row['reservation_id']}</td>";
                    echo "<td>{$row['user_name']}</td>";
                    echo "<td>{$row['table_name']}</td>";
                    echo "<td>{$row['reservation_date']}</td>";
                    echo "<td>{$row['reservation_time']}</td>";
                    echo "<td>{$row['guests']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td><span class=\"status {$statusClass}\">{$row['status']}</span></td>";
                    echo "</tr>";
                }

                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <a href="UserDashboard.php" class="back-btn">Back</a>

</body>
</html>
