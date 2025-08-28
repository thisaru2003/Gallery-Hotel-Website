<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = "Sri Lankan";
$name = "Crispy Chicken Burger";
$description = "Crispy chicken wedged between a homemade bun with cheese, tomato, caramelized onions, pickled gherkins, jalapenos, lettuce and honey mustard mayo.";
$price = 2650.00;
$image_url = "path_to_image.jpg";

$sql = "INSERT INTO menu_items (category, name, description, price, image_url) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("sssdss", $category, $name, $description, $price, $image_url);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
