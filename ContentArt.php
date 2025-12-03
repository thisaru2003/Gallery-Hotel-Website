<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Hotel</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/ContentArt.css">
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

<div class="Mcontent">
    <div class="topic">  
        <h3><b>#Art Gallery</b></h3>
        <p>
            Art in restaurants can significantly enhance the dining experience by creating a unique and engaging atmosphere. 
            It serves as a visual feast, complementing the culinary offerings and adding to the overall ambiance. Art can range 
            from paintings and sculptures to murals and installations, each reflecting the restaurant's theme or style. It can 
            also be a conversation starter, offering guests something to admire and discuss while dining. Whether modern, classic, 
            local, or international, art in restaurants contributes to a memorable and immersive experience for patrons.
        </p>
    </div>

    <div class="wcontent">
        <p><b>- Image Gallery -</b></p>
    </div>

    <div class="wrapper">
        <div class="container">
            <input type="radio" name="slide" id="c1" checked>
            <label for="c1" class="card">
                <div class="row">
                    <div class="icon">1</div>
                </div>
            </label>

            <input type="radio" name="slide" id="c2">
            <label for="c2" class="card">
                <div class="row">
                    <div class="icon">2</div>
                </div>
            </label>

            <input type="radio" name="slide" id="c3">
            <label for="c3" class="card">
                <div class="row">
                    <div class="icon">3</div>
                </div>
            </label>

            <input type="radio" name="slide" id="c4">
            <label for="c4" class="card">
                <div class="row">
                    <div class="icon">4</div>
                </div>
            </label>

            <input type="radio" name="slide" id="c5">
            <label for="c5" class="card">
                <div class="row">
                    <div class="icon">5</div>
                </div>
            </label>
        </div>
    </div>

    <div class="des1">
        <p>
            Art in restaurants goes beyond mere decoration; it shapes the establishment's identity and ambiance. 
            The choice of artwork can convey the restaurant's theme, whether cozy and rustic, sleek and modern, 
            or elegant fine dining. Incorporating local artists or cultural elements connects with the community and 
            provides a sense of place.<br><br>
            Art influences mood, setting a tone aligned with the dining experience. Vibrant pieces energize casual areas, 
            while serene works create calm atmospheres. Arrangement and lighting impact perception, making spaces feel 
            open, intimate, or lively.
        </p>
    </div>

    <div class="des2">
        <p>
            Moreover, art can be storytelling, reflecting the culinary journey or chef's inspiration. It highlights the 
            restaurant's philosophy, such as sustainability or cultural fusion, creating a cohesive narrative. Art engages 
            guests emotionally, making visits memorable and encouraging returns.<br><br>
            Some restaurants host exhibitions or collaborate with artists, supporting the local art scene and keeping the 
            environment dynamic. Ultimately, art enriches the dining experience, offering a feast for the eyes as well as the palate.
        </p>
    </div>
</div>

<div onclick="scrollToTop()" class="scrollTop">Top</div>

<footer>
<?php include('footer.php') ?>
</footer> 

<script>
    function scrollToTop(){
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>        
</body>
</html>
