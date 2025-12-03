<?php

include('db.php');

$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

$admins = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}


header('Content-Type: application/json');
echo json_encode($admins);

$conn->close();
?>
