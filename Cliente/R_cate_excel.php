<?php
// Incluir el archivo de conexión
include("../Servidor/conexion.php");

// nombre del archivo y charset
header('Content-Type: text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="ReporteCategorias.csv"');

// Salida del archivo
$salida = fopen('php://output', 'w');

// Encabezados del CSV
fputcsv($salida, array('ID', 'Categoria'));

// Consulta para obtener los datos
$reporteCsv = mysqli_query($conexion, 'SELECT * FROM categorias');

// Verificar si la consulta fue exitosa
if (!$reporteCsv) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Escribir los datos en el archivo CSV
while ($filaR = mysqli_fetch_assoc($reporteCsv)) {
    fputcsv($salida, array(
        $filaR['idcat'],
        $filaR['categoria']
    ));
}

// Cerrar la salida
fclose($salida);
?>