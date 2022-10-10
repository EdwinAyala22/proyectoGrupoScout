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

if (isset($_POST['crear'])) {
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $responsable = $_POST['responsable'];
    $objetivo_act = $_POST['objetivo_act'];
    $area = $_POST['area'];
    $rama = $_POST['id_rama'];
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

    $sql = "INSERT INTO f_actividades (imagen, responsable, objetivo_act, area, id_rama, fechaInicio, fechaFin, lugar, nombre_act, descri_act, materiales, fact_riesgo, evaluacion_act, f_elab_por, costo)  values ('$imagen','$responsable','$objetivo_act','$area','$rama','$fechaInicio','$fechaFin','$lugar','$nombre_act','$descri_act','$materiales','$fact_riesgo','$evaluacion_act','$f_elab_por','$costo')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

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
            <output id="list"></output>
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
                        <input class="form-control mb-3 input_login fw-bold" type="file" id="formFile" style="height: 38px;" name="imagen" required>
                    </div>
                </div>
                
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="responsable" autofocus placeholder="Responsable de la actividad" title="Responsable de la actividad" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="objetivo_act" placeholder="Objetivo" title="Objetivo" required>
                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="area" placeholder="Área" title="Área" required>
                    </div>
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="id_rama" required title="Seleccione la rama">
                            <option disabled selected value>Seleccione la rama</option>
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
                            <option value="11">No aplica</option>
                        </select>
                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="form-floating">
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fechaInicio" placeholder="Fecha Inicio" data-bs-toggle="tooltip" title="Fecha y hora de inicio" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha inicio</label>
                    </div>
                    <div class="form-floating">
                        <input type="datetime-local" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fechaFin" placeholder="Fecha Final" data-bs-toggle="tooltip" title="Fecha y hora final" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha fin</label>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugar" placeholder="Lugar" title="Lugar" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombre_act" placeholder="Nombre de la actividad" title="Nombrea actividad" required>
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="descri_act" placeholder="Descripción actividad..." title="Descripción actividad..." required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="materiales" placeholder="Materiales..." title="Materiales..." required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="fact_riesgo" placeholder="Factores de riesgo" title="Factores de riesgo" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="evaluacion_act" placeholder="Evaluación actividad" title="Evaluación actividad" required></textarea>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="f_elab_por" placeholder="Actividad elaborada por" title="Actividad elaborada por" required>
                    </div>
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="costo" placeholder="Costo actividad" title="Costo actividad" required>
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
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="img-fluid" src="',e.target.result, '" width="" title="', escape(theFile.name), '"/>'].join('');
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
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list2").innerHTML = ['<img class="" src="',e.target.result, '" width="180px" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('formFile').addEventListener('change', archivo2, false);
</script>

<?php

require '../templates/footer.php';

?>