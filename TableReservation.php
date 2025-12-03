<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="Images/Icon.png"> 
    <link rel="stylesheet" href="CSS/tables.css">
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


    <div class="Mtext"><b>Table Reservations!</b></div>

    <div id="tables-container" class="grid-container">
        <!-- Tables will be dynamically loaded here -->
    </div>

    <div id="reservation-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Reserve Table</h3>
            <form id="reserve-form">
                <input type="hidden" id="selected-table" name="table_name">
                
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required min="" onchange="updateTimeOptions()">

                <label for="time">Time:</label>
                <select name="time" id="time" required>
                    <option value="" disabled selected>Choose a time</option>
                    <!-- Time options will be populated by JavaScript -->
                </select>

                <label for="guests">Number of Guests:</label>
                <input type="number" id="guests" name="guests" min="1" required> 

                <button type="submit">Reserve</button>
            </form>
        </div>
    </div>

    <script src="JS/TableReservations.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <footer>
        <?php include('footer.php') ?>
    </footer>
</body>
</html>
