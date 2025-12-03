<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Gallery Hotel</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/ContentAdmin.css">
    <link rel="stylesheet" href="CSS/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header>
<?php
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
            header("Location: login.php");
            exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
</header> 

<div class="Mtext"><b>Admin Panel</b></div>

<!-- First Row -->
<div class="main">
    <div class="profile-card">
        <div class="img">
            <img src="Images/createuser.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="CreateAdmin.php" class="butn">Create Admin</a>
            </div>                
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manege.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageAdmin.php" class="butn">Manage Admin</a>
            </div>                
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/createuser.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="CreateStaff.php" class="butn">Add Staff</a>
            </div>                  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manege.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="StaffManagement.php" class="butn">Manage Staff</a>
            </div>  
        </div>
    </div>
</div> 

<!-- Second Row -->
<div class="main">
    <div class="profile-card">
        <div class="img">
            <img src="Images/createuser.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="CreateUser.php" class="butn">Add User</a>
            </div>                  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manege.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageUser.php" class="butn">Manage Users</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/addfood.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="AddMenuItem.php" class="butn">Add Food</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manageff.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageItem.php" class="butn">Manage Food</a>
            </div>  
        </div>
    </div>
</div> 

<!-- Third Row -->
<div class="main">
    <div class="profile-card">
        <div class="img">
            <img src="Images/table.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="AddTable.php" class="butn">Add Tables</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/restaurant.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageTables.php" class="butn">Manage Tables</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/addrooms.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="AddRoom.php" class="butn">Add Rooms</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manageroom.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageRooms.php" class="butn">Manage Rooms</a>
            </div>  
        </div>
    </div>
</div> 

<!-- Fourth Row -->
<div class="main">
    <div class="profile-card">
        <div class="img">
            <img src="Images/addevent.jpg" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="AddEvent.php" class="butn">Add Events</a>
            </div>                
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/manageevent.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageEvent.php" class="butn">Manage Events</a>
            </div>                  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/addcelebration.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="AddCelebrations.php" class="butn">Add Celebrations</a>
            </div>  
        </div>
    </div>

    <div class="profile-card">
        <div class="img">
            <img src="Images/managecele.png" alt="">
        </div>
        <div class="caption">
            <div class="info">
                <a href="ManageCelebrations.php" class="butn">Manage Celebrations</a>
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
