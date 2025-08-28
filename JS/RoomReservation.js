document.addEventListener('DOMContentLoaded', () => {
    fetchRooms('all');  

    // Set the minimum date and time to the current date and time
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');

    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');

    // Set the minimum date to the current date
    dateInput.min = `${year}-${month}-${day}`;

    // Set reservation times for 8:00, 12:00, and 17:00
    dateInput.addEventListener('change', updateTimeOptions);

    function updateTimeOptions() {
        const timeInput = document.getElementById('time');
        const selectedDate = new Date(dateInput.value);
        const now = new Date();

        // Clear existing time options
        timeInput.innerHTML = '<option value="" disabled selected>Choose a time</option>';

        const times = ['08:00', '12:00', '17:00'];
        times.forEach(time => {
            const option = document.createElement('option');
            option.value = time;
            option.textContent = time;
            timeInput.appendChild(option);
        });

        // Disable past times if the selected date is today
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

    // Close the modal when the user clicks the close button or outside of the modal
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

    // Handle the reservation form submission
    document.getElementById("room-reserve-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a FormData object to gather the form data
        const formData = new FormData(this);

        // Send the data using the Fetch API
        fetch("process_reservation.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                // alert("Room reserved successfully!");
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
                const modal = document.getElementById("room-reservation-modal");
                modal.style.display = "block";
                document.getElementById("selected-room").value = roomName;
            } else {
                alert("Please log in to reserve a room.");
                window.location.href = "UserProfile.php";
            }
        }
    };
    xhr.send();
}

function filterCategory(category) {
    fetchRooms(category);
}