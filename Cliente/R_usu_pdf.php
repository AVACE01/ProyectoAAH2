<?php
//Inlcuir la libreria de fpdf

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
        $this->Cell(110);
        //Titulo
        $this->Cell(60,10,'REPORTE DE USUARIOS EXISTENTES', 0, 0, 'C');
        //salto de linea
        $this->Ln(30);
        //para dar color RGB a los encabezados de la tabla 
        $this->SetFillColor(245, 140, 117);
        //para dar color al texto RGB
        $this->SetTextColor(61, 55, 54 );
        //tipo d letra 
        $this->SetFont("Arial", 'B', 12);
        //encabezado
        $this->Cell(30, 10, 'Nombre', 1, 0, 'C',true);
        $this->Cell(40, 10, 'Paterno', 1, 0, 'C',true);
        $this->Cell(40, 10, 'Materno', 1, 0, 'C',true);
        $this->Cell(140, 10,utf8_decode( 'Correo'), 1, 0, 'C',true);
        $this->Cell(30, 10,utf8_decode('Teléfono'), 1, 0, 'C',true);
        //salto de linea
        $this->Ln(10);
    }
        //especificar el pie
        function Footer()
        {
            //posicion 1.5 al final de la hoja
            $this->SetFont("Arial", 'B', 8);
            $this->Cell(0,10,'Página'.$this->PageNo(), 0, 0, 'C');

        }
}

//Consulta a la base de datos
require("../Servidor/conexion.php");
$consulta = "SELECT * FROM usuarios";
$resultado=mysqli_query($conexion,$consulta);
$pdf=new PDF('L');
//Hacemos REFERENCIA a la clase
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
while($row=$resultado->fetch_assoc()){

    $pdf->Cell(30,10, utf8_decode($row['NomUsu']), 1, 0, 'C');
    $pdf->Cell(40,10,  utf8_decode($row['ApaUsu']), 1, 0, 'C');
    $pdf->Cell(40,10,  utf8_decode($row['AmaUsu']), 1, 0, 'C');
    $pdf->Cell(140,10,  utf8_decode($row['Correo']), 1, 0, 'C');
    $pdf->Cell(30,10,  utf8_decode($row['telefono']), 1, 0, 'C');
    $pdf->Ln(10);
}
$pdf->OutPut(); //Permite la salida de los datos
?>