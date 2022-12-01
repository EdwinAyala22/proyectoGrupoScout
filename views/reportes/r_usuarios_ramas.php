<?php

// require '../templates/header.php';
require '../../assets/lib/fpdf184/fpdf.php';

include_once '../../queries/conexion.php';

$id_rama = $_POST['rama_progresion'];

$query = "SELECT * FROM ramas WHERE id_rama = $id_rama";
$resultado = mysqli_query($conn, $query);
$array = mysqli_fetch_array($resultado);
$nameRama = $array['nom_rama'];

class PDF extends FPDF {
    
    // Cabecera de página
    function Header() {

        $fecha = date('m-d-Y');

        // echo $fecha;
        $this->Image('../../assets/img/LOGO_GS.png',5,0,33);
        // $this->Text(20,30, 'un texto');
        $this->SetTitle('Reporte_scouts_'.$fecha.'', true);
        // Arial bold 15
        $this->SetFont('Arial','B',12);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,"Reporte de Scouts",0,0,'C');
        $this->Cell(70,10,$fecha,0,0,'C');     
        // Salto de línea
        $this->Ln(35);

        $this->Cell(40,10,'Nombres',1,0,'C',0);
        $this->Cell(40,10,'Apellidos',1,0,'C',0);
        $this->Cell(10,10,'T.D',1,0,'C',0);
        $this->Cell(25,10,'Documento',1,0,'C',0);
        $this->Cell(50,10,'Correo',1,0,'C',0);
        $this->Cell(25,10,'Rama',1,1,'C',0);
        // $this->Cell(15,10,'Celular',1,1,'C',0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
    }
}


$consulta = "SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.id_rama = $id_rama";
$result = mysqli_query($conn, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

while ($row=$result->fetch_assoc()) {
	$pdf->Cell(40,10,utf8_decode($row['nombres']),1,0,'C',0);
	$pdf->Cell(40,10,utf8_decode(''.$row['apellido1'].' '.$row['apellido2'].''),1,0,'C',0);
	$pdf->Cell(10,10,$row['tipodoc'],1,0,'C',0);
	$pdf->Cell(25,10,$row['documento'],1,0,'C',0);
	$pdf->Cell(50,10,$row['correo'],1,0,'C',0);
	$pdf->Cell(25,10,$row['nom_rama'],1,1,'C',0);
	// $pdf->Cell(15,10,$row['telefono'],1,1,'C',0);

} 
    // $pdf->Image('/proyectoGrupoScout/assets/img/LOGO_GS.png',10,10,-300);

	$pdf->Output();

?>
<link rel="shortcut icon" href="/proyectoGrupoScout/assets/img/logo-scout-co.svg" type="image/x-icon">
