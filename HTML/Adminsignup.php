<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_sql = "SELECT * FROM users WHERE name='$name'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username already taken!";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ContentAdmin.php");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
}
?>
