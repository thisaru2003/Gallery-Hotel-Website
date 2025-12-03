<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Daily Selling Items Quantity</title>
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }
        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0a043b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        .date-picker {
            display: block;
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333; 
        }

        #date {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px; 
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        #date:focus {
            border-color: #0a043b; 
            outline: none;
        }

        #dateForm {
            text-align: center; 
            margin: 20px auto; 
            background-color: #f9f9f9; 
            padding: 20px;
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            display: inline-block; 
        }
    </style>
</head>

<body>
    
<form method="GET" action="" id="dateForm">
    <label for="date" class="date-picker">Select Date:</label>
    <input type="date" id="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); ?>" onchange="document.getElementById('dateForm').submit();">
</form>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Daily selling item quantities.
    </p>
</figure>

<?php
include('db.php');


$selectedDate = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");

$query = "SELECT item_name, SUM(quantity) AS total_quantity 
          FROM order_items 
          INNER JOIN orders ON order_items.order_id = orders.id 
          WHERE DATE(orders.order_date) = '$selectedDate' 
          GROUP BY item_name";

$getData = $connection->query($query);

$itemNames = [];
$quantities = [];

if ($getData->num_rows > 0) {
    while ($row = $getData->fetch_assoc()) {
        $itemNames[] = $row['item_name'];
        $quantities[] = (int)$row['total_quantity']; // Convert to integer
    }
} else {
    $itemNames = ['No Sales'];
    $quantities = [0];
}

$connection->close();
?>

<a href="Admincharts.php" class="back-btn">Back</a>
<script>
   Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Daily Selling Items Quantity for <?php echo $selectedDate; ?>'
    },
    xAxis: {
        categories: <?php echo json_encode($itemNames); ?>,
        title: {
            text: 'Items'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Quantity Sold'
        }
    },
    series: [{
        name: 'Quantity Sold',
        data: <?php echo json_encode($quantities); ?>
    }]
});
</script>

</body>
</html>
