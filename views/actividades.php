<title>Actividades</title>
<?php
session_start();
require '../views/templates/header.php';

if (!isset($_SESSION['rol'])) {
    $btn1 = $iniciarBtn;
    $btn2 = $registrarBtn;
} else {
    $btn1 = $menuBtn;
    $btn2 = $logoutBtn;
}


$fechaActual = strtotime(date("Y-m-d H:i:s"));
include_once '../queries/conexion.php'

?>

<div class="container mt-2 mb-4">

    <div class="row text-center">
            <h1 class="titulo fw-bold mt-4">Actividades Scout</h1>
    </div>
    

    <div class="d-flex justify-content-center flex-wrap scroll_acts">
    <?php
    $sql = "SELECT * FROM f_actividades";
    $result = mysqli_query($conn, $sql);
    $counterAct = 0;
    $nr = mysqli_num_rows($result);
    if ($nr != 0) {
        while ($row = mysqli_fetch_array($result)) {
            // $idAct = $row['id_act'];

            // if ($fechaActual > ""){

            // } else {}
            if (strtotime($row['fechaFin']) > $fechaActual) {

                
            
    ?>
            <div class="card mb-3 mt-3 w-75 tarjeta_act" key="<?php echo $row['id_act'] ?>">
                <div class="row g-0">
                    <div class="col-md-5 p-2 m-auto">
                        <img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']);?>" class="img-fluid d-flex m-auto rounded" alt="..." width="200">
                        
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title titulo" id="exampleModalLabel">Detalles...</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong class="titulo">Materiales: </strong><?php echo $row['materiales'] ?></p>
                            <p><strong class="titulo">Lideres a cargo:</strong></p>
                            <ul>
                                <li><?php echo $row['responsable'] ?></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn_general p-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="ins<?php echo $row['id_act'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title titulo" id="exampleModalLabel">INSCRIPCIÓN</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/proyectoGrupoScout/queries/inscribir.php?ia=<?php echo $row['id_act'] ?>" method="POST">

                                <div class="row p-2">
                                    <input type="number" class="form-control" name="documento_act" placeholder="Número de documento" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required>
                                </div>
                                <div class="row p-2">
                                    <input type="text" class="form-control" name="nombre_com" autofocus placeholder="Nombre completo" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre completo" required>
                                </div>
                                <div class="row p-2">
                                    <input type="email" class="form-control" name="correoIns" placeholder="Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required>
                                </div>
                                <div class="row p-2">
                                    <h6 class="titulo text-center"><strong>Adjuntar permisos</strong></h6>
                                </div>
                                <div class="row p-2">
                                    <a href="" class="titulo">Descargar formato</a>
                                </div>
                                <div class="row p-2">
                                    <label for="formFile" class="text-start titulo">Anexe el formato de permiso diligenciado</label>
                                    <input class="form-control archivo" type="file" id="formFile">
                                </div>
                                <input type="hidden" name="idAct" value="<?php echo $row['id_act'] ?>">
                                <div class="modal-footer d-flex flex-wrap">
                                    <button type="button" class="btn btn_general" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn_general">INSCRIBIRME</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    <?php
       $counterAct = $counterAct + 1;
    } }
    }

    if ($counterAct == 0){ 
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
require '../views/templates/footer.php';
?>