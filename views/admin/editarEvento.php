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

$class = "visually-hidden";
$error = "";

// if (isset($_GET['idAct'])) {
$id_act = $_GET['idAct'];
$query = "SELECT * FROM f_actividades WHERE id_act = '$id_act'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
    $mostrar = mysqli_fetch_array($result);
    $id_de_act = $mostrar['id_act'];
    $imgEv = $mostrar['imagen'];
    $resp = $mostrar['responsable'];
    $obj = $mostrar['objetivo_act'];
    $ar = $mostrar['area'];
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
// }

if (isset($_POST['editarEv'])) {
    $id = $_GET["idAct"];
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $responsable = $_POST['responsable'];
    $objetivo_act = $_POST['objetivo_act'];
    $area = $_POST['area'];
    $ramas = $_POST['ramasEvento'];
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

    if ($fechaFiin < $fechaIniciio) {
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "La fecha final no puede ser antes de la fecha inicial.";
    } else {
        $consulta = "UPDATE f_actividades set imagen = '$imagen', responsable = '$responsable', objetivo_act = '$objetivo_act', area = '$area', fechaInicio = '$fechaIniciio', fechaFin = '$fechaFiin', lugar = '$lugar', nombre_act = '$nombre_act', descri_act = '$descri_act', materiales = '$materiales', fact_riesgo = '$fact_riesgo', evaluacion_act = '$evaluacion_act', f_elab_por = '$f_elab_por', costo = '$costo' WHERE id_act = $id";
        if (mysqli_query($conn, $consulta)) {
            $elimRamas = "DELETE FROM ramas_actividades WHERE id_act = $id";
            $resultElim = mysqli_query($conn, $elimRamas);
            if ($resultElim){
                foreach ($ramas as $ram){
                    $sqlInsRama = "INSERT INTO ramas_actividades (id_act, id_rama) values ('$id' , '$ram')";
                    $insRamas = mysqli_query($conn,$sqlInsRama);
                }
                if ($insRamas){
                    echo'<script type="text/javascript">
                alert("El evento se ha modificado con éxito.");
                window.location.href="/proyectoGrupoScout/views/admin/listEventos.php";
                </script>';
                } else {
                    echo "Error insertando las ramas.";
                }
            } else {
                echo "Error eliminando las ramas.";
            }
        } else {
            echo "Error al modificar los datos.";
        }
    }
}
$tRamas = "SELECT * FROM ramas";
$resultR = mysqli_query($conn, $tRamas);

$tRamas2 = "SELECT * FROM ramas_actividades where $id_act = id_act ";
$result3 = mysqli_query($conn, $tRamas2);
$arrayRamas = array();
while ($ramasAct = mysqli_fetch_array($result3)) {
    $arrayRamas[] = $ramasAct['id_rama'];
}
$contador = count($arrayRamas);
$fechaActual = date("Y-m-d H:i");

?>

<title>Editar Evento</title>

<?php

require '../templates/header.php';

?>
<a href="/proyectoGrupoScout/views/admin/listEventos.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container w-100 mt-1 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-4 col-lg-4 col-xl-5">
            <!-- <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto"> -->
            <img src="data:image/jpg;base64,<?php echo base64_encode($imgEv);?>" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($imgEv);?>" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Editar evento</h2>

            <form action="/proyectoGrupoScout/views/admin/editarEvento.php?idAct=<?php echo $id_de_act ?>" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="">
                        <label for="formFile" class="text-start titulo"> <b>Seleccione la nueva imagen del evento:</b></label>
                        <input class="form-control mb-3 input_login fw-bold" type="file" accept="image/*" id="formFile" style="height: 38px;" name="imagen" required >

                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Responsable: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="responsable" type="text" value="<?php echo $resp ?>" required>
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Objetivo Evento: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="objetivo_act" type="text" value="<?php echo $obj ?>" required>
                    </div>


                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Area: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="area" type="text" value="<?php echo $ar ?>" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="text-start titulo form-label fw-bold">Ramas: </label>
                    <div class="d-flex flex-wrap">
                        <?php
                        while ($mostrarR = mysqli_fetch_array($resultR)) {
                            $checked = "";
                                $pAr = 0;
                                for ($i = 1; $pAr <= $contador -  1; $i++){
                                    if($mostrarR['id_rama'] == $arrayRamas[$pAr]){
                                        $checked = "checked";
                                        $pAr = $contador + 1;
                                    } else {
                                        $pAr = $pAr + 1;
                                    }
                                }
                                echo  '<label class="ms-1"><input class="form-check-input me-1" type="checkbox" id="' . $mostrarR['id_rama'] . '" value="' . $mostrarR['id_rama'] . '" name="ramasEvento[]"' . $checked .'>' . $mostrarR['nom_rama'] . '</label> <span class="mx-2 fw-bold">|</span><br> ';
                        }
                        
                        ?>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Inicio: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaInicioo" type="text" value="<?php echo $feInicio ?>" min="<?php echo $fechaActual ?>" required>

                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Fecha y Hora-Fin: </label>
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaFiin" type="text" value="<?php echo $feFin ?>" min="<?php echo $fechaActual ?>" required>

                    </div>
                </div>
                <div class="<?php echo $class ?>" role="alert">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Lugar: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugar" type="text" value="<?php echo $lug ?>" required>
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Nombre Evento: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombre_act" type="text" value="<?php echo $nom_act ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Descripcion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="descri_act" type="text" value="<?php echo $des_act ?>" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Materiales: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="materiales" type="text" value="<?php echo $mat ?>" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Factor de Riesgo: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="fact_riesgo" type="text" value="<?php echo $f_riesgo ?>" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evaluacion Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="evaluacion_act" type="text" value="<?php echo $eva_act ?>" required></input>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label class="form-label fw-bold titulo">Evento Elaborado Por: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="f_elab_por" type="text" value="<?php echo $f_e_por ?>" required>
                    </div>
                    <div class="">
                        <label class="form-label fw-bold titulo">Costo Evento: </label>
                        <input class="form-control mb-3 fw-bold input_login" name="costo" type="text" value="<?php echo $cos ?>" required>
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

<script>
$(document).on('change', 'input[type="file"]', function() {
        // this.files[0].size recupera el tamaño del archivo
        // alert(this.files[0].size);

        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;


        if (fileSize > 16000000) {
            alert('El archivo no debe superar los 16MB');
            // $class = "alert alert-danger alert-dismissible fade show text-center";
            // $error = "El archivo no debe superar los 16MB";
            this.value = '';
            this.files[0].name = '';
        } else {
            // recuperamos la extensión del archivo
            var ext = fileName.split('.').pop();

            // Convertimos en minúscula porque 
            // la extensión del archivo puede estar en mayúscula
            ext = ext.toLowerCase();

            // console.log(ext);
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                    break;
                default:
                    alert('El archivo no tiene la extensión adecuada');
                    this.value = ''; // reset del valor
                    this.files[0].name = '';
            }
        }
    });
</script>

<?php

require '../templates/footer.php';

?>