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
    $table_name = $_POST['table_name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity']; 

    $image_path = $_POST['existing_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = '../Images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $sql = "UPDATE tables SET table_name=?, description=?, image_path=?, capacity=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $table_name, $description, $image_path, $capacity, $id);

    if ($stmt->execute()) {
        header('Location: ManageTables.php');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tables WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $table = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Table</title>
    <link rel="stylesheet" href="../CSS/Manage_Items.css">
</head>
<body>
    <header></header>
    <main>
        <form action="update_table.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($table['id']); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($table['image_path']); ?>">

            <label for="table_name">Name:</label>
            <input type="text" name="table_name" id="table_name" value="<?php echo htmlspecialchars($table['table_name']); ?>" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($table['description']); ?></textarea><br>

            <label for="capacity">Capacity:</label> 
            <input type="number" name="capacity" id="capacity" min="1" value="<?php echo htmlspecialchars($table['capacity']); ?>" required><br>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image"><br>
            <img src="<?php echo htmlspecialchars($table['image_path']); ?>" alt="<?php echo htmlspecialchars($table['table_name']); ?>" width="100"><br>

            <input type="submit" value="Update Table">
        </form>
    </main>
    <a href="ManageTables.php" class="back-btn">Back</a>

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
