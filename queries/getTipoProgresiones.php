<?php

include_once './conexion.php';

$id_rama = $_POST['id_rama'];

$queryP = "SELECT * from tipodeadelanto WHERE id_rama = '$id_rama'";
$resultP = mysqli_query($conn,$queryP);


$select = '<select id="" class="form-select mb-3 fw-bold input_login" name="progresion-seleccionada" required data-bs-toggle="tooltip" data-bs-placement="top" title="Progresión">';

echo $select;

$html = "<option disabled selected value>Seleccionar progresión</option>";
echo $html;

while ($mostrarP = mysqli_fetch_array($resultP)) { 
    echo $html = "<option value='".$mostrarP['id_t_adelanto']."'>".$mostrarP['nombreTipoAdelanto']."</option>";

}

$select = "</select>";
echo $select;


?>
