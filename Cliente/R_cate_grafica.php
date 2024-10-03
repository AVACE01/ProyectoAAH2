<?php
session_start();
include_once("../Servidor/conexion.php");

// Consulta para categorías
$sql = "SELECT c.categoria, COUNT(p.idprod) as cantidad_productos
        FROM categorias c
        LEFT JOIN productos p ON c.idcat = p.idcat
        GROUP BY c.idcat, c.categoria";
        
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
                $rows[] = "['" . $fila["categoria"] . "'," . $fila["cantidad_productos"] . "]";
            }
            echo implode(",", $rows);
            ?>
        ]);
        
        var options = {
            title: 'Distribución de Productos por Categoría',
            width: 600,
            height: 400,
            is3D: true // Esto hace que el gráfico sea en 3D, puedes quitarlo si prefieres 2D
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