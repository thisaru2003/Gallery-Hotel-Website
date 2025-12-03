<?php
include('db.php');

$id = $_GET['id'];
$sql = "DELETE FROM menu_items WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: ManageItem.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
