function updateOrderStatus(orderId, status) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_order_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            location.reload();
        }
    };
    xhr.send("order_id=" + orderId + "&status=" + status);
}
