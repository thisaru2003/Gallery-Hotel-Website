<?php

$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Gallery Café - Manage Rooms</title>
    <link rel="icon" type="image" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/Managerooms.css">
</head>
<body>
<div class="Mtext"><b>Manage Rooms</b></div>
    <table>
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Image</th>
                <th>Room Name</th>
                <th>Category</th>
                <th>Availability Status</th>
                <th>Price</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Manage</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['room_id']; ?></td>
                    <td>
                        <?php if($row['image_url']): ?>
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['room_name']; ?>" width="100">
                        <?php else: ?>
                            <img src="../Images/default_room.png" alt="No Image" width="100">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['room_name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['availability_status']; ?></td>
                    <td><?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td>
                        <a href="update_room.php?id=<?php echo $row['room_id']; ?>" class="btn-update">Update</a>
                    </td>
                    <td>
                        <a href="delete_room.php?id=<?php echo $row['room_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="ContentAdmin.php" class="back-btn">Back</a>
</body>
</html>

<?php
$conn->close();
?>
