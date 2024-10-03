<?php
session_start();
include_once("../Servidor/conexion.php");

// Consulta para obtener estadísticas de usuarios por tipo
$sql = "SELECT t.tipousu, COUNT(u.idtipo) as sum 
        FROM usuarios AS u 
        INNER JOIN tipousuarios AS t 
        ON u.idtipo = t.idtipo 
        GROUP BY u.idtipo";

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
            ['Tipo de Usuario', 'Cantidad'],
            <?php
                $rows = [];
                while ($fila = $res->fetch_assoc()) {
                    $rows[] = "['" . $fila["tipousu"] . "'," . $fila["sum"] . "]";
                }
                echo implode(",", $rows);
            ?>
        ]);

        var options = {
            title: 'Distribución de Usuarios por Tipo',
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