<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel ="icon" type="image" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/ContentEvent.css">
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
    <video autoplay loop muted>
        <source src="../Images/background1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <main>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'gallery_cafe');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT title, description, image_url, event_date, contact_info FROM events ORDER BY event_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<section class="left-align large-font">';
                echo '<div class="card">';
                echo '<div class="card-content">';
                echo '<img src="' . $row["image_url"] . '" alt="Event Image">';
                echo '<h2>' . $row["title"] . '</h2>';
                echo '<p>' . $row["description"] . '<br>Event Date: ' . $row["event_date"] . '<br>Contact: ' . $row["contact_info"] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
            }
        } else {
            echo "<p>No events found.</p>";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <?php include('footer.php'); ?>
    </footer>  
</body>
</html>
