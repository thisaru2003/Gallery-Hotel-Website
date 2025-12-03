<?php
include('db.php');

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

$menu_items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

$conn->close();
echo json_encode($menu_items);
?>
