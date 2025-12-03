<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café - Room Reservations</title>
    <link rel="icon" type="image/png" href="Images/Icon.png">
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

<div class="Mtext"><b>Room Reservations</b></div>
    <div class="container">

        <table id="reservations-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>User Name</th>
                    <th>Room Name</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Duration (hrs)</th>
                    <th>Guests</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="reservation-table-body">
                <?php
                include('db.php');


                $query = "SELECT * FROM room_reservations";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    $statusClass = strtolower($row['status']);
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['room_name']}</td>";
                    echo "<td>{$row['reservation_date']}</td>";
                    echo "<td>{$row['reservation_time']}</td>";
                    echo "<td>{$row['duration']}</td>";
                    echo "<td>{$row['number_of_guests']}</td>";
                    echo "<td><span id=\"status-{$row['id']}\" class=\"status {$statusClass}\">{$row['status']}</span></td>";
                    echo "<td>
                            <button onclick=\"updateReservationStatus({$row['id']}, 'Confirmed')\" class=\"confirm\">Confirm</button>
                            <button onclick=\"updateReservationStatus({$row['id']}, 'Declined')\" class=\"decline\">Decline</button>
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
            xhr.open("POST", "update_room_reservation.php", true);
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
