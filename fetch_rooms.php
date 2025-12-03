<?php
include('db.php');


$category = isset($_GET['category']) && $_GET['category'] !== 'all' ? $_GET['category'] : '';

$sql = "SELECT * FROM rooms";
if ($category) {
    $sql .= " WHERE category = ?";
}

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing SQL statement: " . $conn->error);
}

if ($category) {
    $stmt->bind_param("s", $category);
}

if (!$stmt->execute()) {
    die("Error executing SQL statement: " . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    die("Error fetching result: " . $stmt->error);
}

$rooms = array();
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);

$stmt->close();
$conn->close();
?>
