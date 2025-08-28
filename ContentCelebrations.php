<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel ="icon" type="image" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/ContentCelebrations.css">
</head>
<body>
    <header>
    <?php
session_start();
if (isset($_SESSION['user_role'])) {
    switch ($_SESSION['user_role']) {
        case 'admin':
            include 'adminheader.php';
            break;
        case 'staff':
            include 'staffheader.php';
            break;
        case 'users':
            include 'header.php'; 
            break;
        default:
            include 'header.php'; 
            break;
    }
} else {
    include 'header.php';
}
?> 
    </header>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'gallery_cafe');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch celebration data
    $sql = "SELECT * FROM celebrations";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<section class="flex-container1">';
            echo '    <div class="img1">';
            echo '        <img src="' . $row["image_url"] . '" alt="' . $row["title"] . '">';
            echo '    </div>';
            echo '    <div class="content1">';
            echo '        <h2>' . $row["title"] . '</h2>';
            echo '        <p>' . nl2br($row["description"]) . '</p>';
            echo '    </div>';
            echo '</section>';
        }
    } else {
        echo "No celebrations found.";
    }

    $conn->close();
    ?>

    <footer>
        <?php include('footer.php') ?>
    </footer> 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
