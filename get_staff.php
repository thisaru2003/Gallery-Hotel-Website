<?php

include('db.php');


$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

$staff = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $staff[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($staff);

$conn->close();
?>
