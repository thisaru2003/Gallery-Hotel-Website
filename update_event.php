<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $contact_info = $_POST['contact_info'];

    $image_url = $_POST['existing_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_url = '../Images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    $sql = "UPDATE events SET title=?, description=?, image_url=?, event_date=?, contact_info=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $description, $image_url, $event_date, $contact_info, $id);

    if ($stmt->execute()) {
        header('Location: ManageEvent.php');
        exit();
    } else {
        echo "Error updating event: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="CSS/Manage_Items.css">
</head>
<body>

    <main>
        <form action="update_event.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($event['image_url']); ?>">

            <label for="title">Event Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($event['title']); ?>" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($event['description']); ?></textarea><br>

            <label for="event_date">Event Date:</label>
            <input type="date" name="event_date" id="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>"><br>

            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" id="contact_info" value="<?php echo htmlspecialchars($event['contact_info']); ?>"><br>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image"><br>
            <img src="<?php echo htmlspecialchars($event['image_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" width="100"><br>

            <input type="submit" value="Update Event">
        </form>
    </main>
    <a href="ManageEvent.php" class="back-btn">Back</a>

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
