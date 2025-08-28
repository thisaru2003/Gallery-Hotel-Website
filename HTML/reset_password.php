<?php
session_start();

if (!isset($_SESSION['username'])) {
    $error_message = "You must be logged in to reset your password.";
    exit;
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gallery_cafe"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $username = $_SESSION['username'];

    if ($new_password !== $confirm_password) {
        $error_message = "New passwords do not match.";
    } else {
        $table = null;

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $table = 'users';
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                $table = 'admin';
            } else {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM staff WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count > 0) {
                    $table = 'staff';
                }
            }
        }

        if ($table === null) {
            $error_message = "User not found in any tables.";
        } else {
            $stmt = $conn->prepare("SELECT password FROM $table WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            $stmt->close();

            if (password_verify($current_password, $hashed_password)) {
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                $update_stmt = $conn->prepare("UPDATE $table SET password = ? WHERE username = ?");
                $update_stmt->bind_param("ss", $new_hashed_password, $username);
                
                if ($update_stmt->execute()) {
                    $success_message = "Password successfully reset.";
                } else {
                    $error_message = "Error resetting password: " . $conn->error;
                }

                $update_stmt->close();
            } else {
                $error_message = "Current password is incorrect.";
            }
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="../CSS/restpassword.css">
</head>
<body>
<form action="reset_password.php" method="POST">

    <h2>Reset Password</h2>

    <?php if (isset($success_message)) : ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <?php if (isset($error_message)) : ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <label for="confirm_password">Re-enter New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Reset Password">
    </form>

    <a href="UserDashboard.php" class="back-btn">Back</a>
</body>
</html>
