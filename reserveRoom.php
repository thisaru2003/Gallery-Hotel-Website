<?php
include('db.php');


$room_name = $_POST['room_name'];
$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];
$duration = $_POST['duration'];
$guests = $_POST['guests'];

$sql = "UPDATE rooms SET availability_status = 'reserved' WHERE room_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $room_name);

if ($stmt->execute()) {
    echo 'Success';
} else {
    echo 'Failed';
}

$stmt->close();
$conn->close();
?>
