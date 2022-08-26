<?php

include_once './conexion.php';

$id_rama = $_POST['id_rama'];

$queryP = "SELECT * from tipodeadelanto WHERE id_rama = '$id_rama'";
$resultP = mysqli_query($conn,$queryP);


$html = "<option disabled selected value>Seleccionar progresión</option>";
echo $html;
// while ($mostrarP = mysqli_fetch_array($resultP)) { 
// $html = "<option value='".$mostrarP['id_t_adelanto']."'>".$mostrarP['nombreTipoAdelanto']."</option>";
// }

while ($mostrarP = mysqli_fetch_array($resultP)) { 
    echo $html = "<option value='".$mostrarP['id_t_adelanto']."'>".$mostrarP['nombreTipoAdelanto']."</option>";

}

// echo $html;
// print_r($resultP);
?>
