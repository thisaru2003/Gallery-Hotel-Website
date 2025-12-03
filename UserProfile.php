<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/UserProfile.css">
</head>
<body>
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

<div class="container">
        <button class="btn" onclick="window.location.href='login.php';">
            <span class="btn-text">Login</span>
        </button>
        
        <button class="btn rounded" onclick="window.location.href='create_account.php';">
            <span class="text-green">Create an Account</span>
        </button>
    </div>

</body>
</html>
