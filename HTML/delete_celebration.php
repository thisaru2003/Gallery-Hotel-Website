<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM celebrations WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Celebration deleted successfully";
} else {
    echo "Error deleting celebration: " . $conn->error;
}

header('Location: ManageCelebrations.php');
?>
