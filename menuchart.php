<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Menu Items by Category</title>
    <style> .center-block { display: block; margin-left: auto; margin-right: auto; }
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
    </style>
</head>

<body>
    
<div class="container">
    <center>
        <div id="container"></div>
    </center>
</div>

<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "gallery_cafe";   

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT category, COUNT(*) AS count FROM menu_items GROUP BY category";
$getData = $connection->query($query);
?>
<a href="Admincharts.php" class="back-btn">Back</a>
<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Menu Items by Category'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Categories',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($getData->num_rows > 0) {
                    while ($row = $getData->fetch_object()) {
                        $data .= '{ name:"' . $row->category . '", y:' . $row->count . '},';
                    }
                }
                echo rtrim($data, ',');
                ?>
            ]
        }]
    });
</script>

</body>
</html>
