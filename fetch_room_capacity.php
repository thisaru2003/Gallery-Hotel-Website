<?php
include('db.php');

if (isset($_GET['room_name'])) {
    $roomName = $_GET['room_name'];

    $stmt = $conn->prepare("SELECT capacity FROM rooms WHERE room_name = ?");
    $stmt->bind_param("s", $roomName);
    $stmt->execute();
    $stmt->bind_result($capacity);
    $stmt->fetch();

    if ($capacity !== null) {
        echo json_encode(['success' => true, 'capacity' => $capacity]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Room not found.']);
    }

    $stmt->close();
}
?>
