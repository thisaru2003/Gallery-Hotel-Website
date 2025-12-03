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

<div class="Mtext"><b>Table Reservations</b></div>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="reservation-table-body">
                <?php
                include('db.php');


                $query = "SELECT * FROM reservations";
                $result = $conn->query($query);

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
                    echo "<td><span id=\"status-{$row['reservation_id']}\" class=\"status {$statusClass}\">{$row['status']}</span></td>";
                    echo "<td>
                            <button onclick=\"updateReservationStatus({$row['reservation_id']}, 'Confirmed')\" class=\"confirm\">Confirm</button>
                            <button onclick=\"updateReservationStatus({$row['reservation_id']}, 'Declined')\" class=\"decline\">Decline</button>
                          </td>";
                    echo "</tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <a href="ContentStaff" class="back-btn">Back</a>

    <script>
        function updateReservationStatus(reservationId, status) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_reservation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const statusElement = document.getElementById(`status-${reservationId}`);
                    statusElement.textContent = status;
                    statusElement.className = `status ${status.toLowerCase()}`;
                }
            };

            xhr.send(`reservation_id=${reservationId}&status=${status}`);
        }
    </script>
</body>
</html>
