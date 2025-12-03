<?php

include('db.php');


$sql = "SELECT * FROM celebrations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Gallery Café</title>
    <link rel="icon" type="image" href="Images/Icon.png">
    <link rel="stylesheet" href="CSS/Managerooms.css">
</head>
<body>
<div class="Mtext"><b>Manage Celebrations</b></div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Manage</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['title']; ?>" width="100"></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="update_celebration.php?id=<?php echo $row['id']; ?>" class="btn-update">Update</a>
                    </td>
                    <td>
                        <a href="delete_celebration.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this celebration?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="ContentAdmin" class="back-btn">Back</a>
</body>
</html>

<?php
$conn->close();
?>
