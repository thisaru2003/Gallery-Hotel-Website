<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Room Reservations - The Gallery Café</title>
    <link rel="icon" type="image" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/staff_orders.css">
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

<div class="Mtext"><b>Your Room Reservations</b></div>
    <div class="container">
        <table id="reservations-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Room Name</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Duration (days)</th>
                    <th>Number of Guests</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gallery_cafe";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $logged_in_user = $_SESSION['username']; 

                $query = "
                    SELECT id AS reservation_id, 
                           room_name, 
                           reservation_date, 
                           reservation_time, 
                           duration, 
                           number_of_guests, 
                           status
                    FROM room_reservations
                    WHERE username = '$logged_in_user'
                ";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['reservation_id']}</td>";
                        echo "<td>{$row['room_name']}</td>";
                        echo "<td>{$row['reservation_date']}</td>";
                        echo "<td>{$row['reservation_time']}</td>";
                        echo "<td>{$row['duration']}</td>";
                        echo "<td>{$row['number_of_guests']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No reservations found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <a href="UserDashboard.php" class="back-btn">Back</a>
</body>
</html>
