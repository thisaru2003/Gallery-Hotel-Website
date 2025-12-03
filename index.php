<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Hotel</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/HomePage.css">
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
    <div class="Mtext"><b>Paradise Road The Gallery Hotel</b></div>
    <div class="Mbutton">
        <a href="Gallery.php" class="button"><b>Gallery</b></a>
    </div>
    <div class="Stext1"><b><span3>#EatParadiseRoad #TheGalleryHotel</span3></b></div>
    <div class="container">      
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-button" id="radio1">
                <input type="radio" name="radio-button" id="radio2">
                <input type="radio" name="radio-button" id="radio3">
                <input type="radio" name="radio-button" id="radio4">

                <div class="slide first">
                    <img src="Images/img 1.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="Images/img 2.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="Images/img 3.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="Images/img 4.jpg" alt="">
                </div>
                <!--slide images end-->
                <!--automatic navigation start-->
                <div class="navigation-auto">
                  <div class="auto-button1"></div>
                  <div class="auto-button2"></div>
                  <div class="auto-button3"></div>
                  <div class="auto-button4"></div>
                </div>
                <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
                <label for="radio1" class="manual-button"></label>
                <label for="radio2" class="manual-button"></label>
                <label for="radio3" class="manual-button"></label>
                <label for="radio4" class="manual-button"></label>
            </div>
            <!--manual navigation end-->
            <!--image slider end-->
        </div>
    </div>
    <div class="para">Established in 1998, Paradise Road The Gallery Hotel is housed at No.2 Alfred House Road Housed in the former offices of world-renowned Sri Lankan architect, the late Geoffrey Bawa, and converted into a restaurant, art gallery and gift store by Paradise Road design entrepreneur Udayshanth Fernando.The restaurant is internationally acclaimed today and has become a must-visit for anyone visiting the city of Colombo.Experience fusion in colonial settings Started 21 years ago, this one features on every resident’s ‘must-visit’ list, and not just because it once served as a studio to Sri Lanka’s most well-known architect, Geoffrey Bawa. Situated in a charming courtyard complete with patios, frangipanis, a pond and an adjoining art gallery, The Gallery Café is one of Colombo’s best-looking standalones. Locals go to eat the European fare (read: coq au vin), expats go for the Sri Lankan creations (read: black pork curry), and everyone always orders cocktails and desserts.</div>
    
    <div class="Stext2"><b>Surf in to Following Content Pages</b></div>
    <div class="template"> 
        <div class="wrapper">
            <div class="card">
                <img src="Images/download.jpg">
                <div class="info">
                    <h1>Celebrations</h1>
                    <p>The perfect setting for celebrations, at The Gallery Hotel discover our impressive spaces to suit any special occasion.</p>
                    <a href="ContentCelebrations.php" class="butn">Read More</a>
                </div>
            </div>
        </div> 
        <div class="wrapper">
            <div class="card">
                <img src="Images/Card2.jpg">
                <div class="info">
                    <h1>Events</h1>
                    <p>A place for you to enjoy quality time or catch up with friends.</p>
                    <a href="ContentEvent.php" class="butn">Read More</a>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="card">
                <img src="Images/Card3.jpg">
                <div class="info">
                    <h1>Art</h1>
                    <p>When choosing artwork in a hotel, remember that it helps foster a sense of place for all visitors.</p>
                    <a href="ContentArt.php" class="butn">Read More</a>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="card">
                <img src="Images/Card4.jpg">
                <div class="info">
                    <h1>About</h1>
                    <p>Today Paradise Road has become the strongest design brand in the island with a focus on lifestyle that embodies timeless taste and style.</p>
                    <a href="ContentAbout.php" class="butn">Read More</a>
                </div>
            </div>
        </div>
    </div>    
    <?php include('footer.php') ?>
    <script type="text/javascript">
        var counter =1;
        setInterval(function() {
            document.getElementById('radio'+counter).checked = true;
            counter++;
            if(counter >4){
                counter=1;
            }
        },5000);
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
