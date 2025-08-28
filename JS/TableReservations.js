document.addEventListener('DOMContentLoaded', () => {
    loadTables();

    // Set the minimum date and time to the current date and time
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const guestsInput = document.getElementById('guests');

    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    // Set the minimum date (current date)
    dateInput.min = `${year}-${month}-${day}`;

    // Set the minimum time if the current date is selected
    dateInput.addEventListener('change', () => {
        if (dateInput.value === `${year}-${month}-${day}`) {
            timeInput.min = `${hours}:${minutes}`;
        } else {
            timeInput.min = '00:00';
        }
    });

    document.getElementById('reserve-form').addEventListener('submit', (event) => {
        event.preventDefault();
        reserveTable();
    });

    // Get the modal
    const modal = document.getElementById('reservation-modal');

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName('close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

function loadTables() {
    fetch('get_tables.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('tables-container');
            container.innerHTML = '';
            data.forEach(table => {
                const card = document.createElement('div');
                card.className = 'table-card';
                card.innerHTML = `
                    <img src="${table.image_path}" alt="${table.table_name}">
                    <div class="description">
                        <h3>${table.table_name}</h3>
                        <p>${table.description}</p>
                        <p><strong>Capacity:</strong> ${table.capacity} people</p> 
                        <button onclick="checkLoginStatus('${table.table_name}', ${table.capacity})">Reserve</button>
                    </div>
                `;
                container.appendChild(card);
            });
        });
}


function checkLoginStatus(tableName, capacity) {
    fetch('check_login_table.php')
        .then(response => response.json())
        .then(data => {
            if (data.logged_in) {
                showReservationForm(tableName, capacity);
            } else {
                alert('Please log in to reserve a table.');
                window.location.href = 'UserProfile.php';
            }
        });
}

function showReservationForm(tableName, capacity) {
    const modal = document.getElementById('reservation-modal');
    modal.style.display = 'block';
    document.getElementById('selected-table').value = tableName;

    // Set the maximum number of guests based on the table's capacity
    const guestsInput = document.getElementById('guests');
    guestsInput.max = capacity;  // Set the max attribute to the table's capacity
}

function reserveTable() {
    const formData = new FormData(document.getElementById('reserve-form'));

    fetch('reserve.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'mytablereservation.php';
        } else {
            alert('Reservation failed: ' + data.message);
        }
    });
}

function updateTimeOptions() {
const timeInput = document.getElementById('time');
const dateInput = document.getElementById('date');
const selectedDate = new Date(dateInput.value);
const now = new Date();

// Clear existing time options
timeInput.innerHTML = '<option value="" disabled selected>Choose a time</option>';

// If selected date is today, start from the current hour
let startHour = selectedDate.toDateString() === now.toDateString() ? now.getHours() : 11;

for (let hour = startHour; hour <= 22; hour++) {
    const option = document.createElement('option');
    option.value = `${String(hour).padStart(2, '0')}:00`;
    option.textContent = `${hour}:00`;
    timeInput.appendChild(option);
}
}