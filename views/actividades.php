<title>Actividades</title>
<?php
session_start();


// if (!isset($_SESSION['rol'])) {
//     $btn1 = $iniciarBtn;
//     $btn2 = $registrarBtn;
// } else {
//     $btn1 = $menuBtn;
//     $btn2 = $logoutBtn;
// }
include_once '../queries/conexion.php';

date_default_timezone_set('America/Bogota');

$mensaje = "";

if (isset($_POST['inscribir'])) {

    if (isset($_SESSION['rol'])) {
        // echo "si existe rol";
        $cod_rol = $_SESSION['rol'];
        if ($cod_rol == 1) {
            // echo "no te podes inscribir, sos admin";
            $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "text": "Error, sólo los scouts pueden inscribirse en las actividades.",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/actividades.php";
            }
        });
        
    </script>';
        } else {
            // echo "inscrito pelao";
            $documento = $_SESSION['id_user'];
            // $documento = $_POST['documento_act'];
            $numActividad = $_POST['idAct'];

            // $idAct = $_GET['ia'];

            $sql = "SELECT * FROM usuarios WHERE documento = '" . $documento . "'";
            $result = mysqli_query($conn, $sql);
            $validRamas = mysqli_fetch_array($result);



            $sqlRamas = "SELECT * FROM ramas_actividades WHERE id_act = $numActividad";
            $resultRams  = mysqli_query($conn, $sqlRamas);
            $arrayRamas = array();

            while ($compararR = mysqli_fetch_array($resultRams)) {
                $arrayRamas[] = $compararR['id_rama'];
            }
            $cantRamas = count($arrayRamas);

            if (mysqli_num_rows($result) == 1) {
                $nombreC = '' . $validRamas['nombres'] . ' ' . $validRamas['apellido1'] . ' ' . $validRamas['apellido2'];
                $correoIns = $validRamas['correo'];
                $query = "SELECT * FROM inscritos WHERE documento = $documento AND id_act = $numActividad";
                $execute = mysqli_query($conn, $query);
                if (mysqli_num_rows($execute) == 1) {
                    // echo '<script type="text/javascript">
                    // alert("Ya estás inscrito en el evento");
                    // window.location.href="/proyectoGrupoScout/views/actividades.php";
                    // </script>';
                    $mensaje = '<script lang="javascript">
                            swal.fire({
                                "title":"¡Atención!",
                                "icon": "warning",
                                "text": "Usted ya se encuentra inscrito en el evento.",
                                "confirmButtonText": "Aceptar",
                                "confirmButtonColor": "#ed1b25",
                                "allowOutsideClick": false,
                                "allowEscapeKey" : false
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    window.location = "/proyectoGrupoScout/views/actividades.php";
                                }
                            });
                            
                        </script>';
                } else {
                    $ins = 0;
                    $pAr = 0;
                    for ($i = 1; $pAr <= $cantRamas - 1; $pAr++) {
                        if ($validRamas['id_rama'] == $arrayRamas[$pAr]) {
                            $ins = 1;
                            $pAr = $cantRamas + 1;
                        }
                    }
                    if ($ins == 1) {
                        $consulta = "INSERT INTO inscritos (documento, id_act, nombreC, correoIns) VALUES ('$documento', '$numActividad', '$nombreC', '$correoIns')";
                        if (mysqli_query($conn, $consulta)) {
                            // echo '<script type="text/javascript">
                            // alert("Inscripción realizada");
                            // window.location.href="/proyectoGrupoScout/views/actividades.php";
                            // </script>';
                            $mensaje = '<script lang="javascript">
                            swal.fire({
                                "title":"¡Inscripción realizada!",
                                "text": "Usted ha sido inscrito en la actividad con éxito.",
                                "icon": "success",
                                "confirmButtonText": "Aceptar",
                                "confirmButtonColor": "#1e0941",
                                "allowOutsideClick": false,
                                "allowEscapeKey" : false
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    window.location = "/proyectoGrupoScout/views/actividades.php";
                                }
                            });
                            
                        </script>';
                        } else {
                            // echo "Error al inscribirse en el evento.";
                            $mensaje = '<script lang="javascript">
                                swal.fire({
                                    "title":"¡Error!",
                                    "icon": "error",
                                    "text": "Error al intentar inscribirse en la actividad",
                                    "confirmButtonText": "Aceptar",
                                    "confirmButtonColor": "#ed1b25",
                                    "allowOutsideClick": false,
                                    "allowEscapeKey" : false
                                }).then((result)=>{
                                    if (result.isConfirmed){
                                        window.location = "/proyectoGrupoScout/views/actividades.php";
                                    }
                                });
                                
                            </script>';
                        }
                    } else {
                        $mensaje = '<script lang="javascript">
                            swal.fire({
                                "title":"¡Atención!",
                                "icon": "warning",
                                "text": "No pertenece a ninguna rama asignada para este evento.",
                                "confirmButtonText": "Aceptar",
                                "confirmButtonColor": "#ed1b25",
                                "allowOutsideClick": false,
                                "allowEscapeKey" : false
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    window.location = "/proyectoGrupoScout/views/actividades.php";
                                }
                            });
                            
                        </script>';
                    }
                }
            } else {
                $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "text": "Error, el usuario no está registrado",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/actividades.php";
            }
        });
        
    </script>';
            }
        }
    } else {
        // echo "no existe rol";
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Atención!",
            "icon": "warning",
            "html": "Para poder inscribirse en las actividades debe <b>iniciar sesión</b>",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/actividades.php";
            }
        });
        
    </script>';
    }
}


// if(isset($_SESSION['rol'])){
//     echo "existe rol";
//     $rol = $_SESSION['rol'];
//     $doc = $_SESSION['id_user'];
//     $sql_inscripcion = "SELECT * FROM usuarios WHERE documento = $doc";
//     $result_sql_inscripcion = mysqli_query($conn, $sql_inscripcion);
//     $array_usu = mysqli_fetch_array($result_sql_inscripcion);

//     if($rol == 1){
//         echo "no podes inscribirte";
//     }
// }else{
//     echo "no existe rol";
// }

$sql_act = "SELECT * FROM f_actividades";
$result_act = mysqli_query($conn, $sql_act);
$nr = mysqli_num_rows($result_act);
$fechaActual = strtotime(date("Y-m-d H:i:s"));

require '../views/templates/header.php';

?>

<div class="container mt-2 mb-4">

    <div class="row text-center">
        <h1 class="titulo fw-bold mt-4">Actividades Scout</h1>
    </div>


    <div class="d-flex justify-content-center flex-wrap scroll_acts">
        <?php

        $counterAct = 0;
        if ($nr != 0) {
            while ($row = mysqli_fetch_array($result_act)) {
                $idAct = $row['id_act'];
                if (strtotime($row['fechaFin']) > $fechaActual) {

                    $sqlRams = "SELECT * FROM ramas_actividades AS RA, ramas AS R WHERE RA.id_act = $idAct AND RA.id_rama = r.id_rama";
                    $resultRams = mysqli_query($conn, $sqlRams);
        ?>
                    <div class="card mb-3 mt-3 w-75 tarjeta_act" key="<?php echo $row['id_act'] ?>">
                        <div class="row g-0">
                            <div class="col-md-5 p-2 m-auto">
                                <img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>" class="img-fluid d-flex m-auto rounded" alt="..." width="200">

                            </div>
                            <div class="col-md-7 p-2 m-auto">
                                <div class="card-body">
                                    <h5 class="card-title text-center titulo"><strong><?php echo $row['nombre_act'] ?></strong></h5>
                                    <p class="card-text"><strong class="titulo">Lugar: </strong><?php echo $row['lugar'] ?></p>
                                    <p class="card-text"><strong class="titulo">Costo: </strong>$ <?php echo $row['costo'] ?> </p>
                                    <p class="card-text"><strong class="titulo">Fecha-Hora Inicio: </strong><?php echo $row['fechaInicio'] ?></p>
                                    <p class="card-text"><strong class="titulo">Fecha-Hora Fin: </strong><?php echo $row['fechaFin'] ?></p>
                                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                                        <button type="button" class="btn btn_general m-1" data-bs-toggle="modal" data-bs-target="#act<?php echo $row['id_act'] ?>">
                                            DETALLES
                                        </button>
                                        <button type="button" class="btn btn_general m-1" data-bs-toggle="modal" data-bs-target="#ins<?php echo $row['id_act'] ?>">
                                            INSCRIBIRME
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="act<?php echo $row['id_act'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title titulo" id="exampleModalLabel">Detalles...</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong class="titulo">Nombre actividad: </strong><?php echo $row['nombre_act'] ?></p>
                                    <p><strong class="titulo">Materiales: </strong><?php echo $row['materiales'] ?></p>
                                    <p><strong class="titulo">Lideres a cargo:</strong></p>
                                    <ul>
                                        <li><?php echo $row['responsable'] ?></li>
                                    </ul>

                                    <p><strong class="titulo">Ramas: </strong></p>
                                    <ul>

                                        <?php
                                        while ($mostrarR = mysqli_fetch_array($resultRams)) {
                                            echo  '<li class="">' . $mostrarR['nom_rama'] . "</li>";
                                        } ?>

                                    </ul>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn_general p-1" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="ins<?php echo $row['id_act'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title titulo" id="exampleModalLabel">INSCRIPCIÓN: <?php echo $row['nombre_act'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <!-- <form action="/proyectoGrupoScout/queries/inscribir.php?ia=<?php $row['id_act'] ?>" method="POST"> -->
                                    <!-- <div class="row p-2">
                                            <input type="number" class="form-control fw-bold input_login" name="documento_act" placeholder="Número de documento" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required>
                                        </div>
                                        <div class="row p-2">
                                            <input type="text" class="form-control fw-bold input_login" name="nombre_com" autofocus placeholder="Nombre completo" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre completo" required>
                                        </div>
                                        <div class="row p-2">
                                            <input type="email" class="form-control fw-bold input_login" name="correoIns" placeholder="Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required>
                                        </div> -->
                                    <!-- <div class="row p-2">
                                        <h6 class="titulo text-center"><strong>Adjuntar permisos</strong></h6>
                                    </div>
                                    <div class="row p-2">
                                        <a href="" class="titulo">Descargar formato</a>
                                    </div>
                                    <div class="row p-2">
                                        <label for="formFile" class="text-start titulo">Anexe el formato de permiso diligenciado</label>
                                        <input class="form-control form-control-sm archivo" type="file" id="formFile">
                                    </div> -->
                                    <h5 class="titulo my-5 text-center"> <b>¿Desea inscribirse en este evento?</b> </h5>
                                    <div class="modal-footer d-flex flex-wrap">
                                        <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                                        <form action="./actividades.php" method="POST">
                                            <input type="hidden" name="idAct" value="<?php echo $row['id_act'] ?>">
                                            <button type="submit" name="inscribir" class="btn links_nav">Inscribirme</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        <?php
                    $counterAct = $counterAct + 1;
                }
            }
        }

        if ($counterAct == 0) {
            echo "<div class='container d-flex justify-content-center align-items-center'>
                <div class='card text-dark bg-light mb-5 card_productos mt-5' style='max-width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title fw-bold tituloRojo'><i class='bi bi-exclamation-triangle-fill me-2'></i>Notificación</h5>
                        <p class='card-text titulo'>No hay actividades disponibles en este momento.</p>
                    </div>
                </div>
              </div>";
        }
        ?>
    </div>
</div>

<?php
require '../views/templates/scripts.php';
?>

<?php

echo $mensaje;

require '../views/templates/footer.php';
?>