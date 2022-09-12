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

if (isset($_GET['idAct'])) {
    $id_act = $_GET['idAct'];
    $query = "SELECT * FROM f_actividades WHERE id_act = '$id_act'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $mostrar = mysqli_fetch_array($result);
        $id_de_act = $mostrar['id_act'];
        $resp = $mostrar['responsable'];
        $obj = $mostrar['objetivo_act'];
        $ar = $mostrar['area'];
        $ra = $mostrar['id_rama'];
        $feInicio = $mostrar['fechaInicio'];
        $feFin = $mostrar['fechaFin'];
        $lug = $mostrar['lugar'];
        $nom_act = $mostrar['nombre_act'];
        $des_act = $mostrar['descri_act'];
        $mat = $mostrar['materiales'];
        $f_riesgo = $mostrar['fact_riesgo'];
        $eva_act = $mostrar['evaluacion_act'];
        $f_e_por = $mostrar['f_elab_por'];
        $cos = $mostrar['costo'];
    } else {
        echo "Error";
    }
}

if (isset($_POST['editarEv'])) {
    $id = $_GET["id"];
    $responsable = $_POST['responsable'];
    $objetivo_act = $_POST['objetivo_act'];
    $area = $_POST['area'];
    $rama = $_POST['id_rama'];
    $fechaIniciio = $_POST['fechaInicioo'];
    $fechaFiin = $_POST['fechaFiin'];
    $lugar = $_POST['lugar'];
    $nombre_act = $_POST['nombre_act'];
    $descri_act = $_POST['descri_act'];
    $materiales = $_POST['materiales'];
    $fact_riesgo = $_POST['fact_riesgo'];
    $evaluacion_act = $_POST['evaluacion_act'];
    $f_elab_por = $_POST['f_elab_por'];
    $costo = $_POST['costo'];

    $consulta = "UPDATE f_actividades set responsable = '$responsable', objetivo_act = '$objetivo_act', area = '$area', id_rama = '$rama', fechaInicio = '$fechaIniciio', fechaFin = '$fechaFiin', lugar = '$lugar', nombre_act = '$nombre_act', descri_act = '$descri_act', materiales = '$materiales', fact_riesgo = '$fact_riesgo', evaluacion_act = '$evaluacion_act', f_elab_por = '$f_elab_por', costo = '$costo' WHERE id_act = $id";
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
<a href="/proyectoGrupoScout/views/admin/listEventos.php" class="btn links_nav m-2" id="newUser">Volver</a>

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
            <h2 class="titulo fw-bold text-center py-3">Editar evento</h2>

            <form action="/proyectoGrupoScout/views/admin/editarEvento.php?id=<?php echo $id_de_act ?>" method="POST">

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Responsable: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="responsable" type="text" value="<?php echo $resp ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Objetivo Evento: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="objetivo_act" type="text" value="<?php echo $obj ?>">
                    </div>


                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Area: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="area" type="text" value="<?php echo $ar ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo" >Rama: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="id_rama" required title="Seleccione la rama">
                            <option disabled value>Seleccione la rama</option>
                            <?php
                            switch($ra){
                                case 1:
                            ?>	
                                <option selected value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 2:
                            ?>
                                <option value="1">Lobatos</option>
                                <option selected value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 3:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option selected value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 4:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option selected value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 5:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option selected value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 6:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option selected value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 7:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option selected value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 8:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option selected value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 9:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option selected value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 10:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option selected value="10">Otro</option>
                                <option value="11">No aplica</option>
                            <?php
                                break;
                                case 11:
                            ?>
                                <option value="1">Lobatos</option>
                                <option value="2">Scouts</option>
                                <option value="3">Caminantes</option>
                                <option value="4">Rovers</option>
                                <option value="5">Dirigentes</option>
                                <option value="6">Consejeros</option>
                                <option value="7">Padres de familia</option>
                                <option value="8">Miembros fundadores</option>
                                <option value="9">Inactivos</option>
                                <option value="10">Otro</option>
                                <option selected value="11">No aplica</option>
                            <?php
                                break;
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Inicio: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaInicioo" type="text" value="<?php echo $feInicio ?>">
                        
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Fin: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaFiin" type="text" value="<?php echo $feFin ?>">
                        
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Lugar: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugar" type="text" value="<?php echo $lug ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Nombre Evento: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombre_act" type="text" value="<?php echo $nom_act ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Descripcion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="descri_act" type="text" value="<?php echo $des_act ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Materiales: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="materiales" type="text" value="<?php echo $mat ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Factor de Riesgo: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="fact_riesgo" type="text" value="<?php echo $f_riesgo ?>"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evaluacion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="evaluacion_act" type="text" value="<?php echo $eva_act ?>"></input>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evento Elaborado Por: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="f_elab_por" type="text" value="<?php echo $f_e_por ?>">
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Costo Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="costo" type="text" value="<?php echo $cos ?>">
                    </div>
                </div>


                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="editarEv">Editar</button>
                        <!-- <button type="submit" name="editarEv" > EDITAR pto</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>