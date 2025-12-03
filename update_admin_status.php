<?php
include('db.php');

$data = json_decode(file_get_contents("php://input"), true);

$admin_id = $data['id'];
$is_verified = $data['is_verified'];

$sql = "UPDATE admin SET is_verified = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $is_verified, $admin_id);

$response = array();
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();
?>
