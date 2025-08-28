<?php
include('db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: UserProfile.php");
    exit();
}

$user_name = $_SESSION['username'];

$sqlUser = "SELECT * FROM users WHERE username = ?";
$sqlAdmin = "SELECT * FROM admin WHERE username = ?";
$sqlStaff = "SELECT * FROM staff WHERE username = ?";

$stmtUser = $conn->prepare($sqlUser);
$stmtAdmin = $conn->prepare($sqlAdmin);
$stmtStaff = $conn->prepare($sqlStaff);

$stmtUser->bind_param("s", $user_name);  
$stmtAdmin->bind_param("s", $user_name);
$stmtStaff->bind_param("s", $user_name);

$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

$stmtAdmin->execute();
$resultAdmin = $stmtAdmin->get_result();
$admin = $resultAdmin->fetch_assoc(); 

$stmtStaff->execute();
$resultStaff = $stmtStaff->get_result();
$staff = $resultStaff->fetch_assoc(); 

$currentUser = null;

if ($user) {
    $currentUser = $user;
} elseif ($admin) {
    $currentUser = $admin;
} elseif ($staff) {
    $currentUser = $staff;
} else {
    header("Location: UserProfile.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/UserDashboard.css">
</head>
<body>
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

<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="editpersonaldetails">Edit Personal Details</a></li>
            <li><a href="myorders.php">Oders</a></li>
            <li><a href="mytablereservation.php">Table Reservations</a></li>
            <li><a href="myroomreservations.php">Room Reservations</a></li>
            <li><a href="reset_password.php">Reset Password</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="profile-content">
        <div class="profile-header">
            <img src="../Images/<?php echo htmlspecialchars($currentUser['profile_photo'] ?? 'default.png'); ?>" alt="Profile Photo">
            <div class="Mtext">Welcome, <?php echo htmlspecialchars($currentUser['username'] ?? 'Guest'); ?></div>
        </div>

        <div class="profile-details">
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($currentUser['full_name'] ?? 'N/A'); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($currentUser['username'] ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($currentUser['email'] ?? 'N/A'); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($currentUser['phone'] ?? 'N/A'); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($currentUser['address'] ?? 'N/A'); ?></p>
        </div>
    </div>
</div>

</body>
</html>
