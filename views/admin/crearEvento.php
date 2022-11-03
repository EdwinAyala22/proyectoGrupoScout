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

if (isset($_POST['crear'])) {
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $responsable = $_POST['responsable'];
    $objetivo_act = $_POST['objetivo_act'];
    $area = $_POST['area'];
    $ramas = $_POST['ramasEvento'];
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
    $idActi = 0;
    if ($fechaFin < $fechaInicio){
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "La fecha final no puede ser antes de la fecha inicial.";
    } else {
        $sql = "INSERT INTO f_actividades (imagen, responsable, objetivo_act, area, fechaInicio, fechaFin, lugar, nombre_act, descri_act, materiales, fact_riesgo, evaluacion_act, f_elab_por, costo)  values ('$imagen','$responsable','$objetivo_act','$area','$fechaInicio','$fechaFin','$lugar','$nombre_act','$descri_act','$materiales','$fact_riesgo','$evaluacion_act','$f_elab_por','$costo')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sqlID = "SELECT * FROM f_actividades where responsable = '$responsable' AND objetivo_act = '$objetivo_act' AND area = '$area' AND lugar = '$lugar' AND nombre_act = '$nombre_act' AND descri_act = '$descri_act' AND materiales = '$materiales' AND fact_riesgo = '$fact_riesgo' AND evaluacion_act = '$evaluacion_act' AND f_elab_por = '$f_elab_por' AND costo = '$costo'";
            $resultID = mysqli_query($conn, $sqlID);
            $findID = mysqli_fetch_array($resultID);
            $idActi = $findID['id_act'];
        
            
            if ($idActi != 0){
                foreach ($ramas as $ram){
                    $sqlInsRama = "INSERT INTO ramas_actividades (id_act, id_rama) values ('$idActi' , '$ram')";
                    $insRamas = mysqli_query($conn,$sqlInsRama);
                }
                if ($insRamas){
                    echo'<script type="text/javascript">
                alert("Registro realizado con éxito");
                window.location.href="/proyectoGrupoScout/views/admin/listEventos.php";
                </script>';
                } else {
                    echo "Error";
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$tRamas = "SELECT * FROM ramas";
$resultR = mysqli_query($conn,$tRamas);

$fechaActual = date("Y-m-d H:i");
?>

<title>Crear Evento</title>
<?php

require '../templates/header.php';

?>
<a href="/proyectoGrupoScout/views/admin/listEventos.php" class="btn links_nav m-2">Volver</a>
<div class="container w-75 mt-5 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <!-- <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto"> -->
            <output id="list" class="d-flex justify-content-center"></output>
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <!-- <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid"> -->
                    <output id="list2"></output>
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Crear Evento</h2>
            <!-- formlario registro -->
            <form action="./crearEvento.php" method="POST" class="p-3 form_registro justify-content-center align-items-center" enctype="multipart/form-data">

                <div class="row">
                    <div class="">
                        <label for="formFile" class="text-start titulo"> <b>Seleccione la imagen del evento:</b></label>
                        <input class="form-control mb-3 input_login fw-bold" type="file" accept="image/*" id="formFile" style="height: 38px;" name="imagen" required>
                            
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="responsable" autofocus placeholder="Responsable de la actividad" title="Responsable de la actividad" minlength="10" maxlength="50" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="objetivo_act" placeholder="Objetivo" title="Objetivo" minlength="20" maxlength="200" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>

                </div>
                <div class="row">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="area" placeholder="Área" title="Área" minlength="15" maxlength="100" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="text-start titulo form-check-label"> <b>Seleccione las ramas que participarán:</b></label><br>
                        <div class="d-flex flex-wrap">
                            <?php while ($mostrarR = mysqli_fetch_array($resultR)) {

                              echo  '<label class="ms-1"><input class="form-check-input me-1" type="checkbox" id="' . $mostrarR['id_rama'] . '" value="' . $mostrarR['id_rama'] . '" name="ramasEvento[]">' . $mostrarR['nom_rama'] . '</label> <span class="mx-2 fw-bold">|</span><br> ';
                             } ?>
                        </div>
                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="form-floating">
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fechaInicio" placeholder="Fecha Inicio" data-bs-toggle="tooltip" title="Fecha y hora de inicio" min="<?php echo $fechaActual ?>" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha inicio</label>
                    </div>
                    <div class="form-floating">
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fechaFin" placeholder="Fecha Final" data-bs-toggle="tooltip" title="Fecha y hora final" min="<?php echo $fechaActual ?>" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha fin</label>
                    </div>
                </div>

                <div class="<?php echo $class ?>" role="alert">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugar" placeholder="Lugar" title="Lugar" minlength="20" maxlength="50" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombre_act" placeholder="Nombre de la actividad" title="Nombrea actividad" minlength="10" maxlength="200" required>
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="descri_act" placeholder="Descripción actividad..." title="Descripción actividad..." minlength="30" maxlength="700" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="materiales" placeholder="Materiales..." title="Materiales..." maxlength="400" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="fact_riesgo" placeholder="Factores de riesgo" title="Factores de riesgo" maxlength="400" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="evaluacion_act" placeholder="Evaluación actividad" title="Evaluación actividad" minlength="14" maxlength="400" required></textarea>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="f_elab_por" placeholder="Actividad elaborada por" title="Actividad elaborada por" minlength="6" maxlength="100" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="costo" placeholder="Costo actividad" title="Costo actividad" maxlength="10" pattern="[0-9]" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="crear">Crear Evento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="img-fluid" src="', e.target.result, '" width="" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('formFile').addEventListener('change', archivo, false);

    function archivo2(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Insertamos la imagen
                    document.getElementById("list2").innerHTML = ['<img class="" src="', e.target.result, '" width="180px" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('formFile').addEventListener('change', archivo2, false);

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