<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    
    </style>
<body>
<header>
    <div class="brand">
        <span2><b><img src="../Images/Icon.png" alt="Logo"></b></span2>
        <span1><b>The Gallery Hotel</b></span1>
    </div>
    <div class="navigation">
        <div class="navigation-items">
            <a href="../HTML/index.php">Home</a>
            <a href="../HTML/RoomReservation.php">Rooms</a>
            <a href="../HTML/Menu.php">Menu</a>
            <a href="../HTML/TableReservation.php">Tables</a>
            <a href="../HTML/Parking.php">Parking</a>
            <a href="../HTML/FindUs.php">Find Us</a>
        </div>
    </div>
    <div class="user-info">
        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="UserDashboard.php"><span>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</span></a>';
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="../HTML/UserProfile.php">Login</a>';
        }
        ?>
    </div>
    <div class="dark-mode-toggle">
        <button id="darkModeBtn">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</header>

<script>
    const darkModeBtn = document.getElementById('darkModeBtn');
    const currentTheme = localStorage.getItem('theme');
    
    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        darkModeBtn.innerHTML = '<i class="fas fa-sun"></i>';
    }

    darkModeBtn.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        let theme = 'light';
        if (document.body.classList.contains('dark-mode')) {
            theme = 'dark';
            darkModeBtn.innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            darkModeBtn.innerHTML = '<i class="fas fa-moon"></i>';
        }
        localStorage.setItem('theme', theme);
    });
</script>
</body>
</html>
