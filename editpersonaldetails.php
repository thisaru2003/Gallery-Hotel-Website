<?php
session_start();
require 'db.php'; 

$current_username = $_SESSION['username'];

function getUserDetails($conn, $username) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return ['type' => 'user', 'data' => $result->fetch_assoc()]; 
    }

    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return ['type' => 'admin', 'data' => $result->fetch_assoc()]; 
    }

    $query = "SELECT * FROM staff WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return ['type' => 'staff', 'data' => $result->fetch_assoc()]; 
    }

    return null; 
}

function isUsernameOrEmailTaken($conn, $username, $email, $current_username) {
    $query = "SELECT * FROM users WHERE (username = ? OR email = ?) AND username != ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $current_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; 
    }

    $query = "SELECT * FROM admin WHERE (username = ? OR email = ?) AND username != ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $current_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; 
    }

    $query = "SELECT * FROM staff WHERE (username = ? OR email = ?) AND username != ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $current_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; 
    }

    return false; 
}

$userDetails = getUserDetails($conn, $current_username);
$user = $userDetails['data'] ?? null; 
$userType = $userDetails['type'] ?? null; 

if (!$user) {
    echo "User not found!";
    exit;
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username']; 
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profile_photo = $user['profile_photo']; 

    if (isUsernameOrEmailTaken($conn, $new_username, $email, $current_username)) {
        $error_message = "Error: The username or email is already taken.";
    } else {
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = '../Images/';
            $upload_file = $upload_dir . basename($_FILES['profile_photo']['name']);

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_file)) {
                $profile_photo = basename($_FILES['profile_photo']['name']); 
            } else {
                $error_message = "Error uploading file.";
            }
        }

        if ($user && empty($error_message)) {
            if ($userType === 'user') {
                $update_query = "UPDATE users SET username=?, full_name=?, email=?, phone=?, address=?, profile_photo=? WHERE username=?";
            } elseif ($userType === 'admin') {
                $update_query = "UPDATE admin SET username=?, full_name=?, email=?, phone=?, address=?, profile_photo=? WHERE username=?";
            } elseif ($userType === 'staff') {
                $update_query = "UPDATE staff SET username=?, full_name=?, email=?, phone=?, address=?, profile_photo=? WHERE username=?";
            }

            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sssssss", $new_username, $full_name, $email, $phone, $address, $profile_photo, $current_username);
            if ($update_stmt->execute()) {
                $_SESSION['username'] = $new_username;
                $success_message = "Details updated successfully!";
            } else {
                $error_message = "Error updating details: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Personal Details</title>
    <link rel="stylesheet" href="/CSS/editStaff.css">
</head>
<body>

    <main>
    <form action="" method="POST" enctype="multipart/form-data">

        <h2>Edit Personal Details</h2>
        
        <?php if (!empty($success_message)) : ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($current_username); ?>" required><br><br>

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea><br><br>

            <label for="profile_photo">Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo">
            <?php if ($user['profile_photo']) : ?>
                <p>Current Photo: <img src="../Images/<?php echo htmlspecialchars($user['profile_photo']); ?>" width="100" /></p>
            <?php endif; ?>

            <input type="submit" value="Update Details">
        </form>

        <a href="UserDashboard.php" class="back-btn">Back</a>
    </main>
</body>
</html>
