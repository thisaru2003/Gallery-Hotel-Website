<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM events WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully!";
        header("Location: ManageEvent.php"); 
        exit();
    } else {
        echo "Error deleting event: " . $conn->error;
    }
} else {
    echo "No event ID specified.";
}

$conn->close();
?>
