<?php
include('db.php');

if (isset($_POST['reservation_id']) && isset($_POST['status'])) {
    $reservationId = intval($_POST['reservation_id']);
    $status = $conn->real_escape_string($_POST['status']); // Sanitize input to prevent SQL injection

    $query = "UPDATE room_reservations SET status = '$status' WHERE id = $reservationId";

    if ($conn->query($query) === TRUE) {
        echo "Reservation status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid input.";
}

$conn->close();
?>
