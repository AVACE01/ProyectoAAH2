<?php
session_start();
include_once("../Servidor/conexion.php");

// Consulta adaptada para productos y categorías
$sql = "SELECT c.categoria, COUNT(p.idprod) as cantidad 
        FROM productos AS p 
        INNER JOIN categorias AS c 
        ON p.idcat = c.idcat 
        GROUP BY p.idcat";
        
$res = $conexion->query($sql);
if (!$res) {
    die("Error en la consulta SQL: " . $conexion->error);
}
?>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Categoría', 'Cantidad de Productos'],
            <?php
            $rows = [];
            while ($fila = $res->fetch_assoc()) {
                $rows[] = "['" . $fila["categoria"] . "'," . $fila["cantidad"] . "]";
            }
            echo implode(",", $rows);
            ?>
        ]);
        
        var options = {
            title: 'Productos por Categoría',
            width: 600,
            height: 400,
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>
</head>
<body>
    <div id="chart_div"></div>
</body>
</html>