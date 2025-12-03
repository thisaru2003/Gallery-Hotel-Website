<?php
include('db.php');


$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image" href="Images/Icon.png">
    <link rel="stylesheet" href="CSS/Managerooms.css">
</head>
<body>
<div class="Mtext"><b>Manage Events</b></div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Contact Info</th>
                <th>Manage</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td><img src='" . $row["image_url"] . "' alt='Event Image' width='100'></td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["event_date"] . "</td>";
                    echo "<td>" . $row["contact_info"] . "</td>";
                    echo "<td>";
                    echo "<a href='update_event.php?id=" . $row["id"] . "' class='btn-update'>Update</a> ";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='delete_event.php?id=" . $row["id"] . "' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No events found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="ContentAdmin" class="back-btn">Back</a>
</body>
</html>

<?php
$conn->close();
?>
