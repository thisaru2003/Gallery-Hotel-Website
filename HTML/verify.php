<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $otp = $conn->real_escape_string($_POST['otp']);

    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND otp='$otp' LIMIT 1");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $otp_expiration = $user['otp_expiration'];

        if (strtotime($otp_expiration) > time()) {
            $conn->query("UPDATE users SET is_verified=1, otp=NULL, otp_expiration=NULL WHERE email='$email'");
            header("Location: UserProfile.php");
        } else {
            echo 'OTP has expired. Please request a new one.';
        }
    } else {
        echo 'Invalid OTP. Please try again.';
    }
} else {
    $email = $_GET['email'];
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>OTP Verification</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }
            form {
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                text-align: center;
            }
            form input[type=\"text\"],
            form input[type=\"password\"] {
                width: calc(100% - 20px);
                padding: 10px;
                margin: 15px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
            }
            form input[type=\"hidden\"] {
                display: none;
            }
            form button[type=\"submit\"] {
                background-color: #0e0d58;
                color: #fff;
                padding: 12px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                width: 100%;
                transition: background-color 0.3s ease;
            }
            form button[type=\"submit\"]:hover {
                background-color: #06062e;
            }
            form input[type=\"text\"]:focus,
            form button[type=\"submit\"]:focus {
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                border-color: #007bff;
            }
            form h2 {
                margin-bottom: 20px;
                color: #333;
                font-size: 24px;
            }
            form p {
                margin-top: 20px;
                color: #666;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <form action='verify.php' method='POST'>
            <h2>Verify Your Account</h2>
            <input type='hidden' name='email' value='$email'>
            <input type='text' name='otp' placeholder='Enter OTP' required>
            <button type='submit'>Verify</button>
            <p>Please check your email for the OTP code.</p>
        </form>
    </body>
    </html>
    ";
}
?>
