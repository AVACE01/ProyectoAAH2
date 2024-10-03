<?php
//Incluir la libreria de fpdf
require("lib/fpdf/fpdf.php");

class PDF extends FPDF {
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
        $this->Cell(30,10,'REPORTE DE CATEGORIAS', 0, 0, 'C');
        //salto de linea
        $this->Ln(30);
        //para dar color RGB a los encabezados de la tabla 
        $this->SetFillColor(245, 140, 117);
        //para dar color al texto RGB
        $this->SetTextColor(61, 55, 54);
        //tipo de letra 
        $this->SetFont("Arial", 'B', 12);
        //encabezado
        $this->Cell(30, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(160, 10, 'Categoria', 1, 0, 'C', true);
        //salto de linea
        $this->Ln(10);
    }

    //especificar el pie
    function Footer()
    {
        //posicion 1.5 al final de la hoja
        $this->SetY(-15);
        $this->SetFont("Arial", 'B', 8);
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

//Consulta a la base de datos
require("../Servidor/conexion.php");
$consulta = "SELECT * FROM categorias";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(30, 10, $row['idcat'], 1, 0, 'C');
    $pdf->Cell(160, 10, utf8_decode($row['categoria']), 1, 0, 'C');
    $pdf->Ln(10);
}

$pdf->Output(); //Permite la salida de los datos
?>