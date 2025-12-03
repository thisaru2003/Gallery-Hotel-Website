<?php
include('db.php');


$data = json_decode(file_get_contents('php://input'), true);
$table_id = $data['table_id'];
$user_name = $data['user_name'];
$reservation_time = date('Y-m-d H:i:s');

$sql = "INSERT INTO reservations (table_id, user_name, reservation_time, confirmed) VALUES (?, ?, ?, false)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $table_id, $user_name, $reservation_time);

if ($stmt->execute()) {
    $update_sql = "UPDATE tables SET available = false WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $table_id);
    $update_stmt->execute();
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$conn->close();
?>
