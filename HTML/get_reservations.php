<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, table_id, user_name, reservation_time FROM reservations";
$result = $conn->query($sql);

$reservations = array();
while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

echo json_encode($reservations);

$conn->close();
?>
