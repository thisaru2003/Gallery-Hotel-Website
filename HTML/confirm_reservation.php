<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$reservation_id = $data['reservation_id'];
$table_id = $data['table_id'];

$updateTableSql = "UPDATE tables SET available = 0 WHERE id = ?";
$stmt = $conn->prepare($updateTableSql);
$stmt->bind_param("i", $table_id);
$stmt->execute();

$updateReservationSql = "UPDATE reservations SET status = 'confirmed' WHERE id = ?";
$stmt = $conn->prepare($updateReservationSql);
$stmt->bind_param("i", $reservation_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
