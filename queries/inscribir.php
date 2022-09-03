<?php

include './conexion.php';


$documento = $_POST['documento_act'];
$numActividad = $_POST['idAct'];
$nombreC = $_POST['nombre_com'];
$correoIns = $_POST['correoIns'];
$idAct= $_GET['ia'];


$sql = "SELECT * FROM usuarios WHERE documento = '" . $documento . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $query = "SELECT * FROM inscritos WHERE documento = $documento AND id_act = $idAct";
    $execute = mysqli_query($conn, $query);
    if(mysqli_num_rows($execute) == 1){
        echo '<script type="text/javascript">
        alert("Ya estás inscrito en el evento");
        window.location.href="/proyectoGrupoScout/views/actividades.php";
        </script>';
    }else{
        $consulta = "INSERT INTO inscritos (documento, id_act, nombreC, correoIns) VALUES ('$documento', '$numActividad', '$nombreC', '$correoIns')";
        if (mysqli_query($conn, $consulta)){
            echo '<script type="text/javascript">
            alert("Inscripción realizada");
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

// echo $numActividad;


// mysqli_free_result($result);
mysqli_close($conn);

?>