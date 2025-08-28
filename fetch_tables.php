<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tables";
$result = $conn->query($sql);

$tables = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($tables);

$conn->close();
?>
