document.addEventListener('DOMContentLoaded', () => {
    loadReservations();

    document.getElementById('reservation-table').addEventListener('click', (event) => {
        if (event.target.classList.contains('update-status')) {
            const reservationId = event.target.dataset.id;
            const newStatus = prompt('Enter new status (Pending, Confirmed, Declined):');
            if (newStatus) {
                updateReservationStatus(reservationId, newStatus);
            }
        }
    });
});

function loadReservations() {
    fetch('staff_reservations.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('reservation-table').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            data.forEach(reservation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${reservation.reservation_id}</td>
                    <td>${reservation.user_name}</td>
                    <td>${reservation.table_name}</td>
                    <td>${reservation.reservation_date}</td>
                    <td>${reservation.reservation_time}</td>
                    <td>${reservation.guests}</td>
                    <td class="status-${reservation.status.toLowerCase()}">${reservation.status}</td>
                    <td>
                        <button class="update-status" data-id="${reservation.reservation_id}">Update Status</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        });
}

function updateReservationStatus(reservationId, status) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_reservation.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Successfully updated, now reflect the change on the table row
            const statusElement = document.querySelector(`#status-${reservationId}`);
            statusElement.textContent = status;
            statusElement.className = `status ${status.toLowerCase()}`;
        }
    };

    xhr.send(`reservation_id=${reservationId}&status=${status}`);
}

