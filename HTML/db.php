<?php
$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
