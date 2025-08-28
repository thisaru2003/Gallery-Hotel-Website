<?php

$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Gallery Café - Manage Tables</title>
    <link rel="icon" type="image" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/Managerooms.css">
</head>
<body>
<div class="Mtext"><b>Manage Tables</b></div>

    <table>
        <thead>
            <tr>
                <th>Table ID</th>
                <th>Image</th>
                <th>Table Name</th>
                <th>Description</th>
                <th>Capacity</th> 
                <th>Manage</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <?php if($row['image_path']): ?>
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['table_name']; ?>" width="100">
                        <?php else: ?>
                            <img src="../Images/default_table.png" alt="No Image" width="100">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['table_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['capacity']; ?></td> 
                    <td>
                        <a href="update_table.php?id=<?php echo $row['id']; ?>" class="btn-update">Update</a>
                    </td>
                    <td>
                        <a href="delete_table.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this table?');">Delete</a>
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
