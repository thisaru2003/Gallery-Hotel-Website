<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel ="icon" type="image" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/Gallery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400" rel="stylesheet">
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

    <div class="Mtext"><b>Parking!</b></div>

    <div class="container">
        <div class="gallery">

        <div class="grid-item" onclick="showDetails('../Images/parking5.jpg')">
                <a>
                <img src="../Images/parking5.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery2.jpg')">
                <a>
                <img src="../Images/parking2.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking9.jpg')">
                <a>
                <img src="../Images/parking9.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking4.jpg')">
                <a>
                <img src="../Images/parking4.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking1.jpg')">
                <a>
                <img src="../Images/parking1.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking8.jpg')">
                <a>
                <img src="../Images/parking8.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking6.jpg')">
                <a>
                <img src="../Images/parking6.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/parking7.jpg')">
                <a>
                <img src="../Images/parking7.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking3.jpg')">
                <a>
                <img src="../Images/parking3.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking10.jpg')">
                <a>
                <img src="../Images/parking10.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/parking11.jpg')">
                <a>
                <img src="../Images/parking11.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery12.jpg')">
                <a>
                <img src="../Images/parking12.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div id="modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modal-image">
        <div id="caption"></div>
    </div>        
        </div>
    </div>

    <footer>
        <?php include('footer.php') ?>
    </footer>  
    <script src="../JS/Gallery.js"></script>
</body>
</html>