<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $profile_photo = $_FILES['profile_photo']['name'];

    $blocked_usernames = ['Admin', 'Staff'];
    if (in_array($user_name, $blocked_usernames)) {
        $error_message .= "Error: The username '$user_name' is not allowed.<br>";
    }
    
    if ($password != $confirm_password) {
        $error_message .= "Passwords do not match!<br>";
    }

$check_email = "
    SELECT email FROM users WHERE email = '$email'
    UNION
    SELECT email FROM admin WHERE email = '$email'
    UNION
    SELECT email FROM staff WHERE email = '$email'";
$result_email = $conn->query($check_email);

if ($result_email->num_rows > 0) {
    $error_message .= "Error: The email '$email' is already in use. Please choose a different email.<br>";
}

$check_username = "
    SELECT username FROM users WHERE username = '$user_name'
    UNION
    SELECT username FROM admin WHERE username = '$user_name'
    UNION
    SELECT username FROM staff WHERE username = '$user_name'";
$result_username = $conn->query($check_username);

if ($result_username->num_rows > 0) {
    $error_message .= "Error: The username '$user_name' is already taken. Please choose a different username.<br>";
}


    if (empty($error_message)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $target_dir = "../Images/";
        $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);

        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            $otp = rand(100000, 999999); 
            $otp_expiration = date("Y-m-d H:i:s", strtotime("+10 minutes")); 

            $sql = "INSERT INTO users (full_name, username, email, phone, address, password, profile_photo, otp, otp_expiration)
                    VALUES ('$full_name', '$user_name', '$email', '$phone_number', '$address', '$hashed_password', '$profile_photo', '$otp', '$otp_expiration')";

            if ($conn->query($sql) === TRUE) {
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();                                           
                    $mail->Host       = 'smtp.gmail.com';                     
                    $mail->SMTPAuth   = true;                                   
                    $mail->Username   = 'thisarujayawickrama@gmail.com';      
                    $mail->Password   = 'iyteogmvkhlerrpz';                   
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                    $mail->Port       = 587;                                   

                    $mail->setFrom('thisarujayawickrama@gmail.com', 'The Gallery Café');
                    $mail->addAddress($email, $full_name);                       

                    $mail->isHTML(true);                                        
                    $mail->Subject = 'Verify Your Account - OTP';
                    $mail->Body    = "Dear $full_name,<br><br>Your OTP for account verification is <strong>$otp</strong>.<br>This OTP is valid for 10 minutes.<br><br>Regards,<br>The Gallery Café Team";

                    $mail->send();
                    echo 'Registration successful! Please check your email for the OTP code.';

                    header("Location: verify.php?email=" . urlencode($email));
                    exit;
                } catch (Exception $e) {
                    $error_message .= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
                }
            } else {
                $error_message .= "Error: " . $conn->error . "<br>";
            }
        } else {
            $error_message .= "Error uploading profile photo!<br>";
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
    <title>The Gallery Hotel - Create Account</title>
    <link rel="icon" type="image/png" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/createaccount.css">
</head>
<body>
    <div class="form-container">
        <form action="create_account.php" method="POST" enctype="multipart/form-data" id="createAccountForm">
            <h2>Create an Account</h2>

            <?php if (!empty($error_message)): ?>
                <div class="error-message" style="color: red;">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <label for="profile_photo">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" required><br>

            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required><br>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required><br>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" required><br>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" required><br>

            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Ex: Password123!" name="password" minlength="8" oninput="checkPasswordMatch()" />
            <label id="validationResultp"></label>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="cpassword" class="form-control" name="cpassword" minlength="8" oninput="checkPasswordMatch()" />
            <span id="message"></span>
            <small>Password must include at least 8 characters, including uppercase and lowercase letters, a number, and a special symbol.</small><br>

            <button type="submit" id="createBtn">Create Account</button>
        </form>
    </div>

    <a href="UserProfile.php" class="back-btn">Back</a>

    <script>
        // Check if passwords match
        function checkPasswordMatch() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('cpassword').value;
            var message = document.getElementById('message');
            var submitButton = document.getElementById('createBtn');

            if (password === confirmPassword) {
                message.innerHTML = 'Passwords match';
                message.style.color = 'green';
                submitButton.disabled = false;
            } else {
                message.innerHTML = 'Passwords do not match';
                message.style.color = 'red';
                submitButton.disabled = true;
            }
        }

        // Check password strength
        function validatePasswordStrong(password) {
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
            return regex.test(password);
        }

        document.getElementById("password").addEventListener("input", function() {
            var userInput = this.value;
            var validationResultLabel = document.getElementById("validationResultp");

            if (validatePasswordStrong(userInput)) {
                validationResultLabel.textContent = "Strong Password!";
                validationResultLabel.style.color = "green";
            } else {
                validationResultLabel.textContent = "Password is not strong!";
                validationResultLabel.style.color = "red";
            }
        });
    </script>  
</body>
</html>
