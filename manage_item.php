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
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image_url = $_POST['existing_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_url = '../Images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    $sql = "UPDATE menu_items SET category=?, name=?, description=?, price=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $category, $name, $description, $price, $image_url, $id);

    if ($stmt->execute()) {
        header('Location: ManageItem.php');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM menu_items WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu Item</title>
    <link rel="stylesheet" href="../CSS/Manage_Items.css">
</head>
<body>
    <form action="manage_item.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($item['image_url']); ?>">

        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="Sri Lankan" <?php echo ($item['category'] == 'Sri Lankan') ? 'selected' : ''; ?>>Sri Lankan</option>
            <option value="Chinese" <?php echo ($item['category'] == 'Chinese') ? 'selected' : ''; ?>>Chinese</option>
            <option value="Italian" <?php echo ($item['category'] == 'Italian') ? 'selected' : ''; ?>>Italian</option>
            <option value="Special" <?php echo ($item['category'] == 'Special') ? 'selected' : ''; ?>>Special</option>
            <option value="Beverages" <?php echo ($item['category'] == 'Beverages') ? 'selected' : ''; ?>>Beverages</option>
        </select><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($item['name']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($item['description']); ?></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($item['price']); ?>" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>
        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="100"><br>

        <input type="submit" value="Update Item">
    </form>
    <a href="ManageItem.php" class="back-btn">Back</a>

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
