document.addEventListener('DOMContentLoaded', () => {
    loadTables();

    document.getElementById('add-table-form').addEventListener('submit', (event) => {
        event.preventDefault();
        addTable();
    });

    document.getElementById('update-table-form').addEventListener('submit', (event) => {
        event.preventDefault();
        updateTable();
    });

    document.getElementById('delete-table-form').addEventListener('submit', (event) => {
        event.preventDefault();
        deleteTable();
    });
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
                        <button onclick="editTable(${table.id})">Edit</button>
                        <button onclick="removeTable(${table.id})">Delete</button>
                    </div>
                `;
                container.appendChild(card);
            });
        });
}

function addTable() {
    const formData = new FormData(document.getElementById('add-table-form'));

    fetch('add_table.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        alert(message);
        if (message.includes('New table added successfully')) {
            loadTables();
        }
    });
}

function editTable(tableId) {
    // Populate the form with the table details for editing
    fetch(`get_table.php?id=${tableId}`)
        .then(response => response.json())
        .then(table => {
            document.getElementById('update-table-id').value = table.id;
            document.getElementById('update-table-name').value = table.table_name;
            document.getElementById('update-description').value = table.description;
            // Set the image preview
            const imageInput = document.getElementById('update-image');
            if (table.image_path) {
                // Create a temporary image element to preview the existing image
                const imagePreview = document.createElement('img');
                imagePreview.src = table.image_path;
                imagePreview.alt = 'Table Image';
                imagePreview.style.maxWidth = '200px'; // Adjust size as needed
                document.querySelector('#update-table-form').insertBefore(imagePreview, imageInput);
            } else {
                // Remove any existing preview image
                const existingPreview = document.querySelector('#update-table-form img');
                if (existingPreview) {
                    existingPreview.remove();
                }
            }
        });
}

function updateTable() {
    const formData = new FormData(document.getElementById('update-table-form'));

    fetch('update_tables.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Table updated successfully');
            loadTables();
        } else {
            alert('Update failed: ' + data.message);
        }
    });
}

function removeTable(tableId) {
    if (confirm('Are you sure you want to delete this table?')) {
        const formData = new FormData();
        formData.append('id', tableId);

        fetch('delete_tables.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Table deleted successfully');
                loadTables();
            } else {
                alert('Delete failed: ' + data.message);
            }
        });
    }
}
