<?php
//Incluir la libreria de fpdf
require("lib/fpdf/fpdf.php");
class PDF extends FPDF{
    //CABECERA DE LA PAGINA
    function Header()
    {
        //Logo tipo
        $this->Image("img/Logo_Mecanico.png", 10, 8, 33);
        //tipo de letra
        $this->SetFont("Arial", 'B', 15);
        //movemos a la derecha
        $this->Cell(80);
        //Titulo
        $this->Cell(120,10,'REPORTE DE PRODUCTOS EXISTENTES', 0, 0, 'C');
        //salto de linea
        $this->Ln(30);
        //para dar color RGB a los encabezados de la tabla 
        $this->SetFillColor(245, 140, 117);
        //para dar color al texto RGB
        $this->SetTextColor(61, 55, 54 );
        //tipo d letra 
        $this->SetFont("Arial", 'B', 10);
        //encabezado
        $this->Cell(15, 10, 'ID', 1, 0, 'C',true);
        $this->Cell(30, 10, 'Nombre', 1, 0, 'C',true);
        $this->Cell(50, 10, utf8_decode('Descripción'), 1, 0, 'C',true);
        $this->Cell(20, 10, 'Cantidad', 1, 0, 'C',true);
        $this->Cell(25, 10, 'Precio', 1, 0, 'C',true);
        $this->Cell(25, 10, 'Color', 1, 0, 'C',true);
        $this->Cell(25, 10, utf8_decode('Tamaño'), 1, 0, 'C',true);
        $this->Cell(30, 10, utf8_decode('Categoría'), 1, 0, 'C',true);
        //salto de linea
        $this->Ln(10);
    }
    //especificar el pie
    function Footer()
    {
        //posicion 1.5 al final de la hoja
        $this->SetY(-15);
        $this->SetFont("Arial", 'B', 8);
        $this->Cell(0,10,utf8_decode('Página '.$this->PageNo()), 0, 0, 'C');
    }
}

//Consulta a la base de datos
require("../Servidor/conexion.php");
$consulta = "SELECT p.*, c.categoria FROM productos p 
             LEFT JOIN categorias c ON p.idcat = c.idcat";
$resultado = mysqli_query($conexion, $consulta);
$pdf = new PDF('L');
//Hacemos REFERENCIA a la clase
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
while($row = $resultado->fetch_assoc()){
    $pdf->Cell(15, 10, $row['idprod'], 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($row['nombre']), 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($row['descripcion']), 1, 0, 'C');
    $pdf->Cell(20, 10, $row['cantidad'], 1, 0, 'C');
    $pdf->Cell(25, 10, '$'.number_format($row['precio'], 2), 1, 0, 'C');
    $pdf->Cell(25, 10, utf8_decode($row['color']), 1, 0, 'C');
    $pdf->Cell(25, 10, utf8_decode($row['tamanio']), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($row['categoria']), 1, 0, 'C');
    $pdf->Ln(10);
}
$pdf->Output(); //Permite la salida de los datos
?>