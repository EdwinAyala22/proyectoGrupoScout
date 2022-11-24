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

$clase = "";
$mensaje = "";
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $evento = "SELECT * FROM f_actividades WHERE id_act = $id";
    $result = mysqli_query($conn, $evento);
    $row = mysqli_fetch_array($result);

    $tRamas = "SELECT * FROM ramas R, ramas_actividades A where A.id_act = $id AND A.id_rama = R.id_rama";
    $result2 = mysqli_query($conn,$tRamas);
    

}else{
    $mensaje = '<script lang="javascript">
    swal.fire({
        "title":"¡Error!",
        "icon": "error",
        "confirmButtonText": "Aceptar",
        "confirmButtonColor": "#ed1b25",
        "allowOutsideClick": false,
        "allowEscapeKey" : false
    }).then((result)=>{
        if (result.isConfirmed){
            window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
        }
    });
    
</script>';
}


    




?>

<title>Detalle Evento</title>

<?php

require '../templates/header.php';

?>

<?php
if(isset($result2)){


?>
<a href="/proyectoGrupoScout/views/admin/listeventos.php" class="btn links_nav m-2 <?php echo $clase ?>" id="newUser">Volver</a>

<div class="container mt-5 mb-5 container_general <?php echo $clase ?>">

    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <!-- <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto"> -->
            <img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']);?>" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <!-- <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid"> -->
                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']);?>" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Detalle Evento</h2>
            <!-- formlario registro -->
            <!-- comienzo while -->
                <form class="p-3 form_registro justify-content-center align-items-center">
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <label class="form-label fw-bold titulo">Responsable: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['responsable'] ?>" readonly title="Responsable de la actividad">
                        </div>
                        <div class="">
                            <label class="form-label fw-bold titulo">Objetivo Evento: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['objetivo_act'] ?>" readonly title="Objetivo">
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Area: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['area'] ?>" readonly title="Área">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Ramas: </label> <br>

                            <ul class="m-0 px-3">
                            <?php 
                            
                            while ($mostrarR = mysqli_fetch_array($result2)) {
                                echo  '<li class="">'. $mostrarR['nom_rama'] . "</li>";
                            }
                            echo "<br>";
                            ?> 
                            </ul>
                        </div>

                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <label class="form-label fw-bold titulo">Fecha y Hora-Inicio: </label>
                            <input type="datetime-local" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['fechaInicio'] ?>" readonly title="Fecha y hora de inicio">
                        </div>
                        <div class="">
                            <label class="form-label fw-bold titulo">Fecha y Hora-Fin: </label>
                            <input type="datetime-local" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['fechaFin'] ?>" readonly title="Fecha y hora final">
                        </div>
                    </div>

                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <label class="form-label fw-bold titulo">Lugar: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['lugar'] ?>" readonly title="Lugar">
                        </div>
                        <div class="">
                            <label class="form-label fw-bold titulo">Nombre Evento: </label>
                            <input type="text" class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['nombre_act'] ?>" readonly title="Nombrea actividad">
                        </div>
                    </div>

                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Descripcion Evento: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['descri_act'] ?>" readonly title="Descripción actividad..."></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Materiales: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['materiales'] ?>" readonly title="Materiales..."></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Factor de Riesgo: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['fact_riesgo'] ?>" readonly title="Factores de riesgo"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <label class="form-label fw-bold titulo">Evaluacion Evento: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['evaluacion_act'] ?>" readonly title="Evaluación actividad"></input>
                        </div>
                    </div>

                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <label class="form-label fw-bold titulo">Evento Elaborado Por: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="<?php echo $row['f_elab_por'] ?>" readonly title="Actividad elaborada por">
                        </div>
                        <div class="">
                            <label class="form-label fw-bold titulo">Costo Evento: </label>
                            <input class="form-control mb-3 fw-bold input_login" type="text" value="$<?php echo $row['costo'] ?>" readonly title="Costo actividad">
                        </div>
                    </div>
                </form>
            <!-- fin while -->
        </div>
    </div>

</div>

<?php
}else{
    $clase = "visually-hidden";
    for ($i = 0; $i <= 20; $i++) {
        echo '</br>';
    }
}
?>

<?php

require '../templates/scripts.php';

?>



<?php
echo $mensaje;

require '../templates/footer.php';

?>