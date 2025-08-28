<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel ="icon" type="image" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/FindUs.css">
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
    <main>
        <section class="contact-section">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.9449358342877!2d79.85487231574407!3d6.898777095003425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259602cb3bc09%3A0x677419394138f674!2sThe%20Gallery%20Cafe!5e0!3m2!1sen!2slk!4v1690569001506!5m2!1sen!2slk"
                    width="100%" 
                    height="450" 
                    frameborder="0" 
                    style="border:0;" 
                    allowfullscreen="" 
                    aria-hidden="false" 
                    tabindex="0"></iframe>
            </div>
            <div class="contact-info">
                <h2>FIND US</h2>
                <p>The Gallery Hotel, a renowned dining destination, is located in the heart of Colombo. Nestled at 2 Alfred House Road, Colombo 3, Sri Lanka, our café offers a unique culinary experience combining art, culture, and gastronomy. Easily accessible, The Gallery Café is situated near prominent landmarks such as the British Council and Mandarina Colombo. Whether you're arriving by car, public transport, or on foot, our central location makes it convenient for you to visit.<br><br>Enjoy our exquisite ambiance and delightful dishes in a setting enriched with artistic flair. For detailed directions, please refer to the map above or contact us directly. We look forward to welcoming you and ensuring a memorable dining experience.</p>
                <address>
                    <p><strong>Phone:</strong> +94 11 258 2162 </p>
                    <p><strong>Email:</strong> gallerycafe@paradiseroad.lk</p>
                </address>
            </div>
        </section>
    </main>

    <footer>
        <?php include('footer.php') ?>
    </footer>  
</body>
</html>    