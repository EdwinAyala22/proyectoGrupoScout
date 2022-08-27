<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION['rol'] != 1) {
        header("Location: ../login.php");
    }
}

?>

<?php

include_once '../../queries/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM f_actividades WHERE id_act = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $mostrar = mysqli_fetch_array($result);
        $responsable = $mostrar['responsable'];
        $objetivo_act = $mostrar['objetivo_act'];
        $area = $mostrar['area'];
        $rama = $mostrar['rama'];
        $fechaInicio = $mostrar['fechaInicio'];
        $fechaFin = $mostrar['fechaFin'];
        $lugar = $mostrar['lugar'];
        $nombre_act = $mostrar['nombre_act'];
        $descri_act = $mostrar['descri_act'];
        $materiales = $mostrar['materiales'];
        $fact_riesgo = $mostrar['fact_riesgo'];
        $evaluacion_act = $mostrar['evaluacion_act'];
        $f_elab_por = $mostrar['f_elab_por'];
        $costo = $mostrar['costo'];
    } else {
        echo "Error";
    }
}

if (isset($_POST['editar'])) {
    $id = $_POST["id"];
    $responsable = $_POST['responsable'];
    $objetivo_act = $_POST['objetivo_act'];
    $area = $_POST['area'];
    $rama = $_POST['rama'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $lugar = $_POST['lugar'];
    $nombre_act = $_POST['nombre_act'];
    $descri_act = $_POST['descri_act'];
    $materiales = $_POST['materiales'];
    $fact_riesgo = $_POST['fact_riesgo'];
    $evaluacion_act = $_POST['evaluacion_act'];
    $f_elab_por = $_POST['f_elab_por'];
    $costo = $_POST['costo'];

    $consulta = "UPDATE f_actividades set responsable = '$responsable', objetivo_act = '$objetivo_act', area = '$area', rama = '$rama', fechaInicio = '$fechaInicio', fechaFin = '$fechaFin', lugar = '$lugar', nombre_act = '$nombre_act', descri_act = '$descri_act', materiales = '$materiales', fact_riesgo = '$fact_riesgo', evaluacion_act = '$evaluacion_act', f_elab_por = '$f_elab_por', costo = '$costo' WHERE id_act = $id";
    if (mysqli_query($conn, $consulta)) {
        header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
    } else {
        echo "Error";
    }
}


?>

<title>Editar Evento</title>

<?php

require '../templates/header.php';

?>
<a href="/proyectoGrupoScout/views/admin/listeventos.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container w-100 mt-1 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-4 col-lg-4 col-xl-5">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Editar usuario</h2>

            <form action="./editarEvento.php?id=<?php echo $id_act ?>" method="POST">

                <div class="mb-3">
                    <input type="hidden" name="id" class="form-control" id="exampleInputEmail1" value="<?php echo $mostrar['id_act'] ?>" aria-describedby="emailHelp">
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Responsable: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['responsable'] ?>">
                        <div class="">
                            <label class="form-label fw-bold titulo">Objetivo Evento: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['objetivo_act'] ?>">
                        </div>

                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Area: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['area'] ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Rama: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['rama'] ?>">
                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Inicio: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['fechaInicio'] ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Fin: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['fechaFin'] ?>">
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Lugar: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['lugar'] ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Nombre Evento: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['nombre_act'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Descripcion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['descri_act'] ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Materiales: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['materiales'] ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Factor de Riesgo: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['fact_riesgo'] ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evaluacion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['evaluacion_act'] ?>"></input>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evento Elaborado Por: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $mostrar['f_elab_por'] ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Costo Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" type="text" value="$<?php echo $mostrar['costo'] ?>">
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col d-flex justify-content-center align-items-center p-2">
                    <button type="submit" class="btn btn_general" name="editar">Editar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>