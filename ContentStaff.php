<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Gallery Hotel - Staff Panel</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/ContentAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="Mtext"><b>Staff Panel</b></div>

<div class="main">
    <div class="profile-card">
        <div class="img">
            <img src="Images/oder.jpg" alt="Make Orders">
        </div>
        <div class="caption">
            <div class="info">
                <a href="HTML/StaffMenu.php" class="butn">Make Orders</a>
            </div>                
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/checkout.png" alt="Orders">
        </div>
        <div class="caption">
            <div class="info">
                <a href="StaffOders.php" class="butn">Orders</a>
            </div>                
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/reserved.png" alt="Table Reservations">
        </div>
        <div class="caption">
            <div class="info">
                <a href="StaffReservations.php" class="butn">Table Reservations</a>
            </div>                  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/roomreservation.jpg" alt="Room Reservations">
        </div>
        <div class="caption">
            <div class="info">
                <a href="staffroom_reservation.php" class="butn">Room Reservations</a>
            </div>  
        </div>
    </div>
</div> 

<footer>
<?php include('footer.php') ?>
</footer> 

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
