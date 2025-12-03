<?php
header('Content-Type: application/json');

include('db.php');


$sql = "SELECT * FROM `tables`";
$result = $conn->query($sql);

$tables = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

echo json_encode($tables);

$conn->close();
?>
