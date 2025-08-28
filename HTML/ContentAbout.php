<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>The Gallery Café</title>
        <link rel ="icon" type="image" href="../Images/Icon.png"> 
        <link rel="stylesheet" href="../CSS/ContentAbout.css">
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
        <div class="Mtext"><b>About Us!</b></div>
        <section id="section1"class="flex-container1">
    <div class="img1">
    <img src="../Images/brand.jpg" alt="mothersday">
</div>
    <div class="content1">
        <h2>The Brand</h2>
    <p>Paradise Road was established in 1987 by Sri Lankan design entrepreneur, Udayshanth Fernando. The company was born in retail and later expanded into hospitality with its first café in 1994, first restaurant and art gallery in 1998 and first boutique hotel in 2007. Paradise Road is today a world-renowned design brand that encompasses retail, art, design and hospitality.<br><br>Paradise Road Flagship Store features homeware, serveware, décor, objets d’art, souvenirs and more. All products are curated and designed by Shanth Fernando. Locally made items are manufactured by independent craftspeople ensuring a sustainable growth of the Sri Lankan art and craft industries. Located within the store is the Paradise Road Cafè, the perfect escape from the vibrant hustle and bustle of the city – an ideal location to work from, enjoy all-day Brunch, business meetings or catch-up with friends over coffee and cake. In addition, the space can be reserved for bespoke events.</p>
</div>
</section>
<section id="section2" class="flex-container2">
    <div class="img2">
        <img src="../Images/shanth.jpg" alt="christmas">
        </div>
    <div class="content2">
    <h2>Shanth Fernando</h2>
    <p>Udayshanth J. Fernando, was born in 1949 in Colombo, Sri Lanka and is more commonly referred to as Shanth; meaning inner peace in Sanskrit. At the age of 19 he moved to the Netherlands and furthered his experience in the field of hospitality which included a stint at the famed Pulitzer Hotel in Amsterdam. Shanth then moved to Australia with his European wife, Angelika and continued his work in hospitality working at the Hyatt in Kingsgate. In 1982, Shanth launched his first design business ‘Art of Play’, wholesaling and designing children’s toys and hand-painted ceramics.<br><br>With a passion to develop the Sri Lankan craft industry he began designing and manufacturing the product range in Sri Lanka. In 1987 he established his signature monochrome batik designs and introducing a contemporary aesthetic to local Sri Lankan craft thereby redefining Sri Lankan design. To date, the brand features an international standard while retaining a truly Sri Lankan identity at its core.</p>

</div>
</section>
        <footer>
            <?php include('footer.php') ?>
        </footer>  
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        </body>
</html>