<?php
include('db.php');


$sql = "SELECT id, table_id, user_name, reservation_time FROM reservations";
$result = $conn->query($sql);

$reservations = array();
while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

echo json_encode($reservations);

$conn->close();
?>
