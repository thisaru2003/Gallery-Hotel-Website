<?php
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    $conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

    $query = "DELETE FROM rooms WHERE room_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $room_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Room deleted successfully.";
    } else {
        echo "Error deleting room.";
    }

    $stmt->close();
    $conn->close();

    header('Location: ManageRooms.php');
    exit();
}
?>
