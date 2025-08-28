<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<footer>
        <div class="footer-content">
            <div class="footer-section about">
                <h3>About Us</h3>
                <p>Paradise Road The Gallery Café
                    Open - 10 AM - Midnight</p>
                <div class="contact">
                    <i class="fas fa-phone"></i> <span> 0112 582 162</span>
                    <i class="fas fa-envelope"></i> <span> thegallerycafe@gmail.com</span>
                    <i class="fas fa-map marker"></i> <span> 2 Alfred House Road off Alfred House Gardens,</span><span>Colombo 03,Sri Lanka</span>
                </div>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section contact-form">
                <h3>Contact Us</h3>
                <form action="send_mail.php" method="post">
                    <input type="email" name="email" class="text-input contact-input" placeholder="Your email address...">
                    <textarea name="message" class="text-input contact-input" placeholder="Your message..."></textarea>
                    <button type="submit" class="btn btn-big contact-btn">
                        <i class="fas fa-envelope"></i>
                        Send
                    </button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; The Gallery Café | Designed by Thisaru Jayawickrama
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>  
</body>

</html>