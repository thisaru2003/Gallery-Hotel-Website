<?php
include('db.php');

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profile_photo = $_FILES['profile_photo']['name'] ? $_FILES['profile_photo']['name'] : $user['profile_photo'];

    $check_sql = "SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?
                  UNION 
                  SELECT id FROM admin WHERE (username = ? OR email = ?)
                  UNION 
                  SELECT id FROM staff WHERE (username = ? OR email = ?)";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("sssssss", $username, $email, $user_id, $username, $email, $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $error_message = "Username or email already exists in another record.";
    } else {
        if ($_FILES['profile_photo']['name']) {
            $target_dir = "../Images/";
            $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
            if (!move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                $error_message = "Sorry, there was an error uploading the file.";
            }
        }

        if (!$error_message) {
            $update_sql = "UPDATE users SET full_name = ?, username = ?, email = ?, phone = ?, address = ?, profile_photo = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssssssi", $full_name, $username, $email, $phone, $address, $profile_photo, $user_id);

            if ($update_stmt->execute()) {
                $success_message = "User updated successfully!";
            } else {
                $error_message = "Error updating user: " . $conn->error;
            }
        }
    }

    $check_stmt->close();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Hotel - Edit User</title>
    <link rel="icon" type="image/png" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/editStaff.css">
</head>
<body>

<header>
<?php
session_start();
if (isset($_SESSION['user_role'])) {
    switch ($_SESSION['user_role']) {
        case 'admin':
            include 'adminheader.php';
            break;
        case 'staff':
            include 'staffheader.php';
            break;
        case 'users':
            include 'header.php'; 
            break;
        default:
            include 'header.php'; 
            break;
    }
} else {
    include 'header.php';
}
?> 
</header>

<main>
<form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST" enctype="multipart/form-data">

<h2>Edit User</h2>

<?php if (!empty($success_message)) : ?>
    <p class="success"><?php echo $success_message; ?></p>
<?php endif; ?>

<?php if (!empty($error_message)) : ?>
    <p class="error"><?php echo $error_message; ?></p>
<?php endif; ?>

<label for="full_name">Full Name</label>
<input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

<label for="username">Username</label>
<input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

<label for="email">Email</label>
<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

<label for="phone">Phone</label>
<input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

<label for="address">Address</label>
<textarea id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>

<label for="profile_photo">Profile Photo</label>
<input type="file" id="profile_photo" name="profile_photo">
<?php if (!empty($user['profile_photo'])) : ?>
    <p>Current Photo: <img src="../Images/<?php echo $user['profile_photo']; ?>" width="100" /></p>
<?php endif; ?>

<button type="submit">Update User</button>
</form>

<a href="ManageUser.php" class="back-btn">Back</a>
</main>

</body>
</html>
