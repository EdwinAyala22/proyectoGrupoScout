<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: /proyectoGrupoScout/views/login.php");
} else {
    if ($_SESSION['rol'] != 1) {
        header("Location: /proyectoGrupoScout/views/login.php");
    }
}

?>

<?php

include_once '../../queries/conexion.php';

$documento = $_POST['documento'];
$id_t_adelanto = $_POST['id_t_adelanto'];

$query = "SELECT * FROM usuarios U, segui_plan_adelanto S WHERE U.documento = S.documento AND S.id_t_adelanto = $id_t_adelanto AND S.documento = $documento;";
$result = mysqli_query($conn, $query);
$nr = mysqli_num_rows($result);

$mostrar = mysqli_fetch_array($result);

    // print_r($mostrar);


?>

<title>Detalle Progresión</title>

<?php

require '../templates/header.php';

?>


<?php

require '../templates/footer.php';

?>