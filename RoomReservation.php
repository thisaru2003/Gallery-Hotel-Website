<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="icon" type="image/png" href="../Images/Icon.png"> 
    <link rel="stylesheet" href="../CSS/RoomReservation.css">
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

    <div class="Mtext"><b>Room Reservations!</b></div>

    <div class="filter-container">
        <label for="category-filter">Filter by Category:</label>
        <select class="category-filter" onchange="filterCategory(this.value)">
            <option value="all">All Categories</option>
            <option value="Single Rooms">Single Rooms</option>
            <option value="Double Rooms">Double Rooms</option>
            <option value="Master Bed Rooms">Master Bed Rooms</option>
            <option value="AC Double Rooms">AC Double Rooms</option>
            <option value="AC Master Bed Rooms">AC Master Bed Rooms</option>
        </select>
    </div>

    <div id="rooms-container" class="grid-container">
        <!-- Rooms will be dynamically loaded here -->
    </div>

    <div id="room-reservation-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Reserve Room</h3>
            <form id="room-reserve-form" method="POST">
                <input type="hidden" id="selected-room" name="room_name">
            
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required min="" onchange="updateTimeOptions()">
            
                <label for="time">Time:</label>
                <select name="time" id="time" required>
                    <option value="" disabled selected>Choose a time</option>
                    <!-- Time options will be populated by JavaScript -->
                </select>
                
                <label for="duration">Duration (in days):</label>
                <input type="number" id="duration" name="duration" min="1" max="5" required>
            
                <label for="guests">Number of Guests:</label>
                <input type="number" id="guests" name="guests" min="1" required>
            
                <button type="submit">Reserve</button>
            </form>
        </div>
    </div>

    <footer>
        <?php include('footer.php'); ?>
    </footer>
    <script>
        let selectedRoomCapacity = 0; 

        document.addEventListener('DOMContentLoaded', () => {
            fetchRooms('all');  

            const dateInput = document.getElementById('date');
            const now = new Date();
            dateInput.min = now.toISOString().split('T')[0];

            dateInput.addEventListener('change', updateTimeOptions);
        });

        function updateTimeOptions() {
            const timeInput = document.getElementById('time');
            const selectedDate = new Date(document.getElementById('date').value);
            const now = new Date();

            timeInput.innerHTML = '<option value="" disabled selected>Choose a time</option>';

            const times = ['08:00', '12:00', '17:00'];
            times.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                timeInput.appendChild(option);
            });

            if (selectedDate.toDateString() === now.toDateString()) {
                times.forEach(time => {
                    const [hours, minutes] = time.split(':');
                    const timeOption = new Date();
                    timeOption.setHours(hours, minutes);
                    if (timeOption <= now) {
                        const option = timeInput.querySelector(`option[value="${time}"]`);
                        option.disabled = true;
                    }
                });
            }
        }

        const modal = document.getElementById('room-reservation-modal');
        const span = document.getElementsByClassName('close')[0];
        span.onclick = function() {
            modal.style.display = 'none';
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        document.getElementById("room-reserve-form").addEventListener("submit", function(event) {
            event.preventDefault(); 

            const guestsInput = document.getElementById('guests').value;
            const numberOfGuests = parseInt(guestsInput, 10);

            if (numberOfGuests > selectedRoomCapacity) {
                alert(`The number of guests (${numberOfGuests}) exceeds the room capacity (${selectedRoomCapacity}).`);
                return; 
            }

            const formData = new FormData(this);

            fetch("process_reservation.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'room_reservation_summary.php';
                    modal.style.display = "none";
                } else {
                    alert("Error reserving room: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("There was a problem with the reservation.");
            });
        });

        function fetchRooms(category) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch_rooms.php?category=${category}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const rooms = JSON.parse(xhr.responseText);
                    displayRooms(rooms);
                }
            };
            xhr.send();
        }

        function displayRooms(rooms) {
            const roomsContainer = document.getElementById("rooms-container");
            roomsContainer.innerHTML = "";  

            rooms.forEach(room => {
                const roomElement = document.createElement("div");
                roomElement.classList.add("room");

                roomElement.innerHTML = `
                    <img src="${room.image_url}" alt="${room.room_name}">
                    <h4>${room.room_name}</h4>
                    <p>${room.description}</p>
                    <p><strong>Price:</strong> Rs${room.price}/night</p>
                    <p><strong>Capacity:</strong> ${room.capacity} people</p>
                    <button onclick="openReservationForm('${room.room_name}')">Reserve</button>
                `;

                roomsContainer.appendChild(roomElement);
            });
        }

        function openReservationForm(roomName) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "check_login_table.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.logged_in) {
                fetchRoomCapacityAndShowForm(roomName);
            } else {
                alert("Please log in to reserve a room.");
                window.location.href = "UserProfile.php";
            }
        }
    };
    xhr.send();
}

function fetchRoomCapacityAndShowForm(roomName) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `fetch_room_capacity.php?room_name=${roomName}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                selectedRoomCapacity = response.capacity;

                const modal = document.getElementById("room-reservation-modal");
                modal.style.display = "block";

                document.getElementById("selected-room").value = roomName;
            } else {
                alert("Error fetching room capacity: " + response.message);
            }
        }
    };
    xhr.send();
}


        function filterCategory(category) {
            fetchRooms(category);
        }
    </script>

</body>
</html>
