<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image" href="../Images/Icon.png">
    <link rel="stylesheet" href="../CSS/Menu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.checkout-form {
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none; 
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.checkout-form form {
    background: #fff;
    margin left: 40%;
    border-radius: 8px;
    padding: 20px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.checkout-form .title {
    margin-bottom: 20px;
    font-size: 1.5em;
    text-align: center;
    color: #333;
}

.checkout-form .inputBox {
    margin-bottom: 15px;
}

.checkout-form .inputBox span {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.checkout-form .inputBox input,
.checkout-form .inputBox select {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1em;
    color: #333;
}

.checkout-form .inputBox input:focus,
.checkout-form .inputBox select:focus {
    border-color: #0056b3;
    outline: none;
}

.checkout-form .submit-btn {
    background: #0056b3;
    color: #fff;
    border: none;
    padding: 10px 15px;
    font-size: 1.1em;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    text-align: center;
    transition: background 0.3s ease;
}

.checkout-form .submit-btn:hover {
    background: #004494;
}
</style>
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


<div class="categories-container">
    <div class="category-icon" onclick="filterCategory('Sri Lankan')">
        <img src="../Images/srilankan.png" alt="Sri Lankan">
        <p>Sri Lankan</p>
    </div>
    <div class="category-icon" onclick="filterCategory('Chinese')">
        <img src="../Images/chinese.png" alt="Chinese">
        <p>Chinese</p>
    </div>
    <div class="category-icon" onclick="filterCategory('Italian')">
        <img src="../Images/italian.png" alt="Italian">
        <p>Italian</p>
    </div>
    <div class="category-icon" onclick="filterCategory('Special')">
        <img src="../Images/special.png" alt="Special">
        <p>Special</p>
    </div>
    <div class="category-icon" onclick="filterCategory('Beverages')">
        <img src="../Images/beverages.png" alt="Beverages">
        <p>Beverages</p>
    </div>
</div>
<div class="menu-container">
    <div class="menu-header">
        <select class="category-filter" onchange="filterCategory(this.value)">
            <option value="all">All Categories</option>
            <option value="Sri Lankan">Sri Lankan</option>
            <option value="Chinese">Chinese</option>
            <option value="Italian">Italian</option>
            <option value="Special">Special Food</option>
            <option value="Beverages">Beverages</option>
        </select>
        <input type="text" class="search-input" placeholder="Search Food..." onkeyup="searchFood(this.value)">
    </div>
    <div id="menu-items" class="menu-items">
        <!-- Items will be dynamically populated here -->
    </div>
</div>

<div class="cart-button" onclick="toggleCartTab()">
    <span class="cart-count">0</span>
    <img src="../Images/cart.png" alt="Cart">
</div>

<div class="cartTab">
    <button class="close-btn" onclick="closeCart()">×</button>
    <div class="listCart">
        <!-- Cart items will be dynamically populated here -->
    </div>
    <div class="cart-total">
        Total Price: Rs. <span id="total-price">0.00</span>
    </div>
    <button class="checkout-btn" onclick="checkout()">Check Out</button>
</div>

<div class="checkout-form">
    <form id="checkout-form">
        <button type="button" class="Check-outForm-close-btn" onclick="closeCheckoutForm()">X</button>
        <h3 class="title">Billing Address</h3>
    <div class="inputBox">
        <span>Date:</span>
        <input type="date" name="order_date" id="order-date" required min="" onchange="updateTimeOptions()">
    </div>
    <div class="inputBox">
        <span>Time:</span>
        <select name="order_time" id="order-time" required>
            <option value="" disabled selected>Choose a time</option>
            <!-- Time options will be populated by JavaScript -->
        </select>
    </div>
    <div class="inputBox">
        <span>Dine In or Take Away:</span>
        <select name="dine_takeaway" required>
            <option value="" disabled selected>Choose an option</option>
            <option value="Dine In">Dine In</option>
            <option value="Take Away">Take Away</option>
        </select>
    </div>
    <input type="button" value="Submit" class="submit-btn" onclick="submitCheckoutForm()">
</form>
</div>
<script>
document.getElementById('order-date').min = new Date().toISOString().split("T")[0];

function updateTimeOptions() {
    const dateInput = document.getElementById('order-date').value;
    const timeSelect = document.getElementById('order-time');
    timeSelect.innerHTML = ''; 

    if (dateInput) {
        const currentTime = new Date();
        const selectedDate = new Date(dateInput);
        const options = [];

        const startHour = 11;
        const endHour = 22; 
        
        const currentHour = currentTime.getHours();

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minute = 0; minute < 60; minute += 30) {
                const timeString = `${hour % 12 === 0 ? 12 : hour % 12}:${minute.toString().padStart(2, '0')} ${hour < 12 ? 'AM' : 'PM'}`;
                
                if (!(selectedDate.toDateString() === currentTime.toDateString() && hour < currentHour)) {
                    options.push(timeString);
                }
            }
        }

        options.forEach(time => {
            const option = document.createElement('option');
            option.value = time;
            option.textContent = time;
            timeSelect.appendChild(option);
        });
    }
}
</script>

    <script src="../JS/Menu.js"></script>
<script>


    </script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

<?php include('footer.php') ?>
</body>
</html>
