<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = $_POST['room_name'];
    $category = $_POST['category'];
    $availability_status = $_POST['availability_status'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $description = $_POST['description'];

    $target_dir = "../Images/"; 
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $error_message = "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) { 
        $error_message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_extensions)) {
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error_message = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;

            $stmt = $conn->prepare("INSERT INTO rooms (room_name, category, availability_status, price, capacity, description, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdiss", $room_name, $category, $availability_status, $price, $capacity, $description, $image_url);


            if ($stmt->execute()) {
                $success_message = "New room added successfully!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="Images/Icon.png">
    <link rel="stylesheet" href="CSS/addcelebrations.css">
</head>
<body>

    <main>
        <h1>Add New Room</h1>

        <?php if (isset($success_message)) : ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="AddRoom.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="room_name">Room Name:</label>
                <input type="text" id="room_name" name="room_name" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Single Rooms">Single Rooms</option>
                    <option value="Double Rooms">Double Rooms</option>
                    <option value="Master Bed Rooms">Master Bed Rooms</option>
                    <option value="AC Double Rooms">AC Double Rooms</option>
                    <option value="AC Master Bed Rooms">AC Master Bed Rooms</option>
                </select>
            </div>
            <div>
                <label for="availability_status">Availability Status:</label>
                <select id="availability_status" name="availability_status">
                    <option value="available">Available</option>
                    <option value="reserved">Reserved</option>
                </select>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required>
            </div>
            <div>
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
            </div>
            <div>
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit">Add Room</button>
            </div>
        </form>
    </main>

    <a href="ContentAdmin.php" class="back-btn">Back</a>

    <script src="tinymce/tinymce.min.js"></script>  
    <script>
    tinymce.init({
        selector:'#description',
        plugins:['wordcount','advlist','autolink','lists','charmap',
        'preview','searchreplace','code','visualblocks','table',
        'fullscreen','help'],
        toolbar:'undo redo | block |' +
        'bold italic backcolor | alignleft aligncenter ' + 
        'alignright alignjustify | bullist numlist outdent indent | '+ 
        'removeformat | help ',
        content_style:'body { font-family:Helvetica,Arial,sans-serif;font-size:16px }'
    });
    </script>
</body>
</html>
