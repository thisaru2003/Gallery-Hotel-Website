let cart = [];
let userName = ''; 

$(document).ready(function() {
    initializeMenu();
});

function initializeMenu() {
    $.ajax({
        url: 'fetch_menu_items.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            let menuItems = {};
            data.forEach(function(item) {
                if (!menuItems[item.category]) {
                    menuItems[item.category] = [];
                }
                menuItems[item.category].push(item);
            });

            let menuHtml = '';
            for (let category in menuItems) {
                menuHtml += `<div class="category" id="${category}">`;
                menuHtml += `<h2>${category}</h2>`; 
                menuItems[category].forEach(function(item) {
                    menuHtml += `<div class="category-item">
                        <img src="${item.image_url}" alt="${item.name}">
                        <div class="category-item-info">
                            <h3>${item.name}</h3>
                            <p class="category-item-description">${item.description}</p>
                            <p class="category-item-price">Rs.${item.price}</p>
                            <button class="add-to-cart-btn" onclick='addToCart(${JSON.stringify(item)})'>Add to Cart</button>
                        </div>
                    </div>`;
                });
                menuHtml += `</div>`;
            }
            $('#menu-items').html(menuHtml);
            filterCategory('all'); 
            updateCartCount(); 
        },
        error: function(xhr, status, error) {
            console.error('Error fetching menu items:', error);
        }
    });
}

function filterCategory(category) {
    var categories = document.getElementsByClassName('category');
    for (var i = 0; i < categories.length; i++) {
        categories[i].style.display = category === 'all' || categories[i].id === category ? 'block' : 'none';
    }

    var selectElement = document.querySelector('.category-filter');
    if (selectElement.value !== category) {
        selectElement.value = category;
    }
}

function searchFood(query) {
    var items = document.getElementsByClassName('category-item');
    for (var i = 0; i < items.length; i++) {
        var itemName = items[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
        items[i].style.display = itemName.includes(query.toLowerCase()) ? 'flex' : 'none';
    }
}

function addToCart(item) {
    checkLoginStatus(function(loggedIn) {
        if (!loggedIn) {
            alert('Please log in to add items to the cart.');
            window.location.href = 'UserProfile.php';
            return;
        }

        const existingItem = cart.find(cartItem => cartItem.name === item.name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            item.quantity = 1;
            cart.push(item);
        }

        updateCartCount();
        renderCartItems();

        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                user_name: userName,
                item_name: item.name,
                quantity: item.quantity,
                image_url: item.image_url
            },
            success: function(response) {
                console.log('Cart updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error updating cart:', error);
            }
        });
    });
}

function updateCartCount() {
    $('.cart-count').text(cart.reduce((total, item) => total + item.quantity, 0));
}

function closeCart() {
    document.querySelector('.cartTab').classList.remove('active');
}

function renderCartItems() {
    let cartHtml = '';
    let totalPrice = 0;

    cart.forEach(function(item) {
        const isMaxQuantity = item.quantity >= 10;
        
        cartHtml += `<div class="cart-item">
            <img src="${item.image_url}" alt="${item.name}">
            <div class="cart-item-info">
                <h3>${item.name}</h3>
                <p>Price: Rs. ${item.price}</p>
                <div class="cart-buttons">
                    <button onclick="changeQuantity('${item.name}', -1)">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button onclick="changeQuantity('${item.name}', 1)" ${isMaxQuantity ? 'disabled' : ''}>+</button>
                    <button class="delete-btn" onclick="removeFromCart('${item.name}')">Delete</button>
                </div>
            </div>
        </div>`;

        totalPrice += item.price * item.quantity;
    });

    document.querySelector('.listCart').innerHTML = cartHtml;
    document.getElementById('total-price').textContent = totalPrice.toFixed(2);
}


function changeQuantity(name, delta) {
    const item = cart.find(cartItem => cartItem.name === name);
    if (item) {
        item.quantity += delta;
        if (item.quantity <= 0) {
            removeFromCart(name);
        } else {
            renderCartItems();
            updateCartCount();
        }
    }
}

function removeFromCart(name) {
    cart = cart.filter(cartItem => cartItem.name !== name);
    renderCartItems();
    updateCartCount();
}

function checkout() {
            if (cart.length === 0) {
                alert('Your cart is empty. Add some items before proceeding to checkout.');
                return;
            }

            $('.checkout-form').show();
}
function closeCheckoutForm() {
    document.querySelector('.checkout-form').style.display = 'none';
}

function submitCheckoutForm() {
    const formData = {
        dine_takeaway: $('select[name="dine_takeaway"]').val(),
        order_date: $('input[name="order_date"]').val(),
        order_time: $('select[name="order_time"]').val(),
        user_name: userName,
        cart: JSON.stringify(cart)
    };

    if (!formData.dine_takeaway || !formData.order_date || !formData.order_time) {
        alert('Please fill out all fields.');
        return;
    }
    
    $.ajax({
    url: 'process_checkout.php',
    method: 'POST',
    data: formData,
    success: function(response) {
        const data = JSON.parse(response);
        if (data.status === 'success') {
            window.location.href = 'order_summary.php'; 
        } else {
            alert('Error during checkout: ' + data.message);
        }
    },
    error: function(xhr, status, error) {
        console.error('Error during checkout:', error);
        alert('Error during checkout. Please try again.');
    }
});

}


function toggleCartTab() {
    checkLoginStatus(function(loggedIn) {
        if (!loggedIn) {
            alert('Please log in to view your cart.');
            window.location.href = 'UserProfile.php';
            return;
        }
        $('.cartTab').toggleClass('active');
        if ($('.cartTab').hasClass('active')) {
            fetchCartItems();
        }
    });
}

function fetchCartItems() {
    $.ajax({
        url: 'fetch_cart_items.php',
        method: 'POST',
        data: { user_name: userName },
        dataType: 'json',
        success: function(data) {
            let cartHtml = '';
            data.forEach(function(item) {
                cartHtml += `<div class="cart-item">
                    <img src="${item.image_url}" alt="${item.item_name}">
                    <div class="cart-item-info">
                        <h3>${item.item_name}</h3>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                </div>`;
            });
            $('.listCart').html(cartHtml);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching cart items:', error);
        }
    });
}

function checkLoginStatus(callback) {
    $.ajax({
        url: 'check_login.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            callback(response.loggedIn);
        },
        error: function(xhr, status, error) {
            console.error('Error checking login status:', error);
            callback(false);
        }
    });
}
