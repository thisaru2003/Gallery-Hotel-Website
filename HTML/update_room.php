<?php
$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $query = "SELECT * FROM rooms WHERE room_id = $room_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Room not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_name = $_POST['room_name'];
    $category = $_POST['category'];
    $availability_status = $_POST['availability_status'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $description = $_POST['description'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_url = $target_file;
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        $image_url = $room['image_url'];
    }

    $update_query = "UPDATE rooms SET 
                        room_name = '$room_name', 
                        category = '$category', 
                        availability_status = '$availability_status', 
                        price = '$price', 
                        capacity = '$capacity', 
                        description = '$description', 
                        image_url = '$image_url' 
                    WHERE room_id = $room_id";

    if ($conn->query($update_query) === TRUE) {
        echo "Room updated successfully!";
        header("Location: ManageRooms.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room - The Gallery Café</title>
    <link rel="icon" type="image/png" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/Manage_Items.css">
</head>
<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="room_name">Room Name:</label>
        <input type="text" name="room_name" id="room_name" value="<?php echo $room['room_name']; ?>" required><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="<?php echo $room['category']; ?>" required><br><br>

        <label for="availability_status">Availability:</label>
        <select name="availability_status" id="availability_status" required>
            <option value="available" <?php if ($room['availability_status'] == 'available') echo 'selected'; ?>>Available</option>
            <option value="reserved" <?php if ($room['availability_status'] == 'reserved') echo 'selected'; ?>>Reserved</option>
        </select><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo $room['price']; ?>" step="0.01" required><br><br>

        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" value="<?php echo $room['capacity']; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="5" required><?php echo $room['description']; ?></textarea><br><br>

        <label for="image">Room Image:</label>
        <input type="file" name="image" id="image"><br><br>
        <img src="<?php echo $room['image_url']; ?>" alt="Room Image" width="100"><br><br>

        <button type="submit">Update Room</button>
    </form>

    <a href="ManageRooms.php" class="back-btn">Back</a>

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
