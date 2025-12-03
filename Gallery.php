<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel ="icon" type="image" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/Gallery.css">
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
?>
    <div class="Mtext"><b>Gallery!</b></div>

    <div class="container">
        <div class="gallery">

        <div class="grid-item" onclick="showDetails('../Images/gallery1.jpg')">
                <a>
                <img src="../Images/gallery1.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery2.jpg')">
                <a>
                <img src="../Images/gallery2.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery3.jpg')">
                <a>
                <img src="../Images/gallery3.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery4.jpg')">
                <a>
                <img src="../Images/gallery4.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery5.jpg')">
                <a>
                <img src="../Images/gallery5.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery6.jpg')">
                <a>
                <img src="../Images/gallery6.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery7.jpg')">
                <a>
                <img src="../Images/gallery7.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery8.jpg')">
                <a>
                <img src="../Images/gallery8.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery9.jpg')">
                <a>
                <img src="../Images/gallery9.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery10.jpg')">
                <a>
                <img src="../Images/gallery10.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery11.jpg')">
                <a>
                <img src="../Images/gallery11.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery12.jpg')">
                <a>
                <img src="../Images/gallery12.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery13.jpg')">
                <a>
                <img src="../Images/gallery13.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery14.jpg')">
                <a>
                <img src="../Images/gallery14.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery15.jpg')">
                <a>
                <img src="../Images/gallery15.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery16.jpg')">
                <a>
                <img src="../Images/gallery16.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery17.jpg')">
                <a>
                <img src="../Images/gallery17.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery18.jpg')">
                <a>
                <img src="../Images/gallery18.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery19.jpg')">
                <a>
                <img src="../Images/gallery19.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery20.jpg')">
                <a>
                <img src="../Images/gallery20.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>

            <div class="grid-item" onclick="showDetails('../Images/gallery21.jpg')">
                <a>
                <img src="../Images/gallery21.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery22.jpg')">
                <a>
                <img src="../Images/gallery22.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery23.jpg')">
                <a>
                <img src="../Images/gallery23.jpg" class="gallery-item" onclick="openModal(this)">
                </a>
            </div>
            
            <div class="grid-item" onclick="showDetails('../Images/gallery24.jpg')">
                <a>
                <img src="../Images/gallery24.jpg" class="gallery-item" onclick="openModal(this)">
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