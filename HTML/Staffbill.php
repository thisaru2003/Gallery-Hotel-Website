<?php
$conn = new mysqli('localhost', 'root', '', 'gallery_cafe');

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); 

    $sql_order = "SELECT * FROM orders WHERE id = $order_id";
    $order_result = $conn->query($sql_order);
    
    if ($order_result->num_rows > 0) {
        $order = $order_result->fetch_assoc();

        $sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
        $items_result = $conn->query($sql_items);
    } else {
        die("No order found with the specified ID.");
    }
} else {
    die("Invalid order ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
        .bill-container {
            max-width: 230px; 
            margin: auto;
            border: 1px solid #000;
            padding: 10px; 
        }
        .bill-header {
            text-align: center;
            margin-bottom: 15px; 
        } 
        .bill-header h1 {
            margin: 0;
            font-size: 16px; 
        }
        .bill-details {
            margin-bottom: 15px;
        }
        .bill-item {
            display: flex;
            justify-content: space-between;
            font-size: 14px; 
        }
        .total {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 5px; 
            font-size: 14px;
            justify-content: space-between;
        }
        .payment-section {
            margin-top: 15px;
            justify-content: space-between;
            font-size: 14px;
            justify-content: space-between;
        }
        .balance {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 5px; 
            font-size: 14px;
            margin-top: 10px;
            justify-content: space-between;
        }
        .btn {
            display: block;
            margin: 15px auto;
            padding: 8px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        @media print {
            .btn, #amount_paid {
                display: none;  
            }
            .bill-container {
                width: 100%; 
            }
        }
    </style>
</head>
<body>
    <div class="bill-container" id="bill">
        <div class="bill-header">
            <h1>Bill</h1>
            <p>Date: <?php echo isset($order['order_date']) ? $order['order_date'] : ''; ?></p>
            <p>Time: <?php echo isset($order['order_time']) ? $order['order_time'] : ''; ?></p>
            <p>Dine/Takeaway: <?php echo isset($order['dine_takeaway']) ? $order['dine_takeaway'] : ''; ?></p>
        </div>
        
        <div class="bill-details">
            <?php 
            $total = 0;
            if (isset($items_result)) {
                while ($item = $items_result->fetch_assoc()): 
                    $total += $item['price'] * $item['quantity'];
            ?>
                <div class="bill-item">
                    <span><?php echo $item['item_name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                    <span>Rs<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endwhile; ?>
            <div class="total">
                <span>Total:</span>
                <span>Rs<?php echo number_format($total, 2); ?></span>
            </div>
            <?php } ?>
        </div>

        <div class="payment-section">
            <label for="amount_paid">Amount Paid: <span id="paidAmount">Rs0.00</span></label>
            <input type="number" id="amount_paid" placeholder="Enter Amount" min="0" step="0.01">
            <div class="balance" id="balance_display"></div>
        </div>

        <button class="btn" id="printButton">Print Bill</button>
    </div>

    <script>
    document.getElementById('printButton').addEventListener('click', function() {
    window.print();

    setTimeout(function() {
        const orderId = <?php echo $order_id; ?>;
        
        fetch('update_payment_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `order_id=${orderId}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); 
            window.location.href = 'StaffOders.php';
        })
        .catch(error => console.error('Error updating payment status:', error));
    }, 500);
});


    document.getElementById('amount_paid').addEventListener('input', function() {
        const totalAmount = <?php echo $total; ?>;
        const amountPaid = parseFloat(this.value);
        const balance = amountPaid - totalAmount;

        document.getElementById('paidAmount').textContent = 'Rs' + (amountPaid ? amountPaid.toFixed(2) : '0.00');

        if (!isNaN(balance) && balance >= 0) {
            document.getElementById('balance_display').textContent = 'Balance: Rs' + balance.toFixed(2);
        } else {
            document.getElementById('balance_display').textContent = 'Amount insufficient or invalid.';
        }
    });
</script>

</body>
</html>
