<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $image_url = $_POST['existing_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_url = '../Images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    $sql = "UPDATE celebrations SET title=?, description=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $description, $image_url, $id);

    if ($stmt->execute()) {
        header('Location: ManageCelebrations.php');
        exit();
    } else {
        echo "Error updating celebration: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM celebrations WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $celebration = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Celebration</title>
    <link rel="stylesheet" href="../CSS/Manage_Items.css">
</head>
<body>

    <main>
        <form action="update_celebration.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($celebration['id']); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($celebration['image_url']); ?>">

            <label for="title">Celebration Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($celebration['title']); ?>" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($celebration['description']); ?></textarea><br>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image"><br>
            <img src="<?php echo htmlspecialchars($celebration['image_url']); ?>" alt="<?php echo htmlspecialchars($celebration['title']); ?>" width="100"><br>

            <input type="submit" value="Update Celebration">
        </form>
    </main>
    <a href="ManageCelebrations.php" class="back-btn">Back</a>

    <script src="./tinymce/tinymce.min.js"></script>
    <script>
    tinymce.init({
        selector:'#description',
        plugins:['wordcount','advlist','autolink','lists','charmap',
        'preview','searchreplace','code','visualblocks','table',
        'fullscreen','help'],
        toolbar:'undo redo | block |' +
        'bold italic backcolor |alignleft aligncenter ' + 
        'alignright alignjustify | bullist numlist outdent indent | '+ 
        'removeformat | help ',
        content_style:'body { font-family:Helvetica,Arial,sans-serif;font-size:16px }'
    });
    </script>
</body>
</html>
