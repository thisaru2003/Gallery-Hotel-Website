<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = mysqli_real_escape_string($conn, $_POST['username_email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $tables = ['users', 'staff', 'admin'];
    $login_success = false;
    $error_message = "";

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table WHERE (username = ? OR email = ?) AND is_verified = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username_email, $username_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username']; 
                $_SESSION['user_role'] = $table;

                switch ($table) {
                    case 'users':
                        header("Location: index.php");
                        break;
                    case 'staff':
                        header("Location: ContentStaff.php");
                        break;
                    case 'admin':
                        header("Location: ContentAdmin.php");
                        break;
                }
                $login_success = true;
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "Invalid username/email or your account is not verified.";
        }
    }

    if (!$login_success && empty($error_message)) {
        $error_message = "Invalid login credentials.";
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
    <link rel="icon" type="image" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="POST">
            <h2>Login</h2>

            <?php if (!empty($error_message)) : ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <label for="username_email">Username or Email</label>
            <input type="text" name="username_email" id="username_email" required><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
    <a href="UserProfile.php" class="back-btn">Back</a>
</body>
</html>
