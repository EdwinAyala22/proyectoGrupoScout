<?php

include './conexion.php';


$documento = $_POST['documento_act'];
$numActividad = $_POST['idAct'];
$nombreC = $_POST['nombre_com'];
$correoIns = $_POST['correoIns'];
$idAct= $_GET['ia'];

$sql = "SELECT * FROM usuarios WHERE documento = '" . $documento . "'";
$result = mysqli_query($conn, $sql);
$validRamas = mysqli_fetch_array($result);

$sqlRamas = "SELECT * FROM ramas_actividades WHERE id_act = $numActividad";
$resultRams  = mysqli_query($conn, $sqlRamas);
$arrayRamas = array();

while ($compararR = mysqli_fetch_array($resultRams)){
    $arrayRamas[] = $compararR['id_rama'];
}
$cantRamas = count($arrayRamas);

if (mysqli_num_rows($result) == 1) {
    $query = "SELECT * FROM inscritos WHERE documento = $documento AND id_act = $idAct";
    $execute = mysqli_query($conn, $query);
    if(mysqli_num_rows($execute) == 1){
        echo '<script type="text/javascript">
        alert("Ya estás inscrito en el evento");
        window.location.href="/proyectoGrupoScout/views/actividades.php";
        </script>';
    }else{
        $ins = 0;
        $pAr = 0;
            for ($i = 1; $pAr <= $cantRamas - 1; $pAr++ ){
                if ($validRamas['id_rama'] == $arrayRamas[$pAr]){
                    $ins = 1;
                    $pAr = $cantRamas + 1;
                } 
            }
            if ($ins == 1){
                $consulta = "INSERT INTO inscritos (documento, id_act, nombreC, correoIns) VALUES ('$documento', '$numActividad', '$nombreC', '$correoIns')";
                    if (mysqli_query($conn, $consulta)){
                        echo '<script type="text/javascript">
                        alert("Inscripción realizada");
                        window.location.href="/proyectoGrupoScout/views/actividades.php";
                        </script>';
                    } else {
                        echo "Error al inscribirse en el evento.";
                    }
            } else {
                echo '<script type="text/javascript">
                alert("No pertenece a ninguna rama asignada para este evento.");
                window.location.href="/proyectoGrupoScout/views/actividades.php";
                </script>';
            }
        }

} else {
    echo '<script type="text/javascript">
        alert("El usuario no está registrado");
        window.location.href="/proyectoGrupoScout/views/actividades.php";
        </script>';
}
mysqli_close($conn);

?>