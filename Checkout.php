<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/Checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="container">
    <form action="process_payment.php" method="post">
        <div class="row">
            <div class="col">
                <h3 class="title">billing address</h3>
                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" name="full_name" placeholder="Charlie Bieber" required>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="email" placeholder="charlie@gmail.com" required>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="address" placeholder="room - street - locality" required>
                </div>
                <div class="inputBox">
                    <span>contact number :</span>
                    <input type="text" name="contact_number" placeholder="012 345 6789" required>
                </div>
                <div class="inputBox">
                    <span>dine in or take away :</span>
                    <select name="dine_takeaway" required>
                        <option value="" disabled selected>Choose an option</option>
                        <option value="Dine In">Dine In</option>
                        <option value="Take Away">Take Away</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" value="Pay" class="submit-btn">
    </form>
</div> 

<footer>
<?php include('footer.php') ?>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
