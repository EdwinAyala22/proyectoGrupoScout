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
date_default_timezone_set('America/Bogota');
$fechaActual = date("Y-m-d H:i");
$fechaActualCom = date("Y-m-d H:i:s");

$mensaje = "";
$evento = "SELECT * FROM f_actividades";
$result = mysqli_query($conn, $evento);
$nr = mysqli_num_rows($result);

// $ramas ="SELECT * FROM f_actividades A, ramas R, ramas_actividades AR WHERE A.id_act = AR.id_act AND AR.id_rama =  R.id_rama";
// $resultR = mysqli_query($conn,$ramas);

if (isset($_GET['delete'])) {
  $idAct = $_GET['delete'];
  $query = "DELETE FROM inscritos WHERE id_act = '$idAct'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $queryRamEl = "DELETE FROM ramas_actividades WHERE id_act = $idAct";
    $resultRamEl = mysqli_query($conn, $queryRamEl);
    if ($resultRamEl) {
      $query2 = "DELETE FROM f_actividades WHERE id_act = '$idAct'";
      $result2 = mysqli_query($conn, $query2);
      if ($result2) {
        header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
      } else {
        // echo "Error eliminando el evento seleccionado.";
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
    } else {
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
  } else {
    // echo "Error eliminando inscritos.";
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
}


?>

<title>Eventos</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
  <h1 class="titulo fw-bold text-center m-3">Lista de eventos</h1>
  <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearEvento.php">Crear nuevo</a>
  <table class="table table-borderless table-bordered display responsive nowrap" style="width: 100%;" id="tabla">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th>Nombre</th>
        <th>Lugar</th>
        <th>Costo</th>
        <th>Fecha-Inicio</th>
        <!-- <th>Fecha-Fin</th> -->
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr != 0) {

        while ($mostrar = mysqli_fetch_array($result)) {

      ?>

          <tr>
            <td> <p></p> <?php echo $mostrar['nombre_act'] ?></td>
            <td> <p></p> <?php echo $mostrar['lugar'] ?></td>
            <td> <p></p> $<?php echo $mostrar['costo'] ?></td>
            <td> <p></p> <?php echo $mostrar['fechaInicio'] ?></td>
           <!--  <td> <p></p> <?php $mostrar['fechaFin'] ?></td>-->
            <td>
              <div class="d-flex justify-content-center align-items-center flex-wrap" >
                <a class="m-1 btn btnDetalles" href="./detalleEvento.php?id=<?php echo $mostrar['id_act'] ?>"> Detalles</a>
                <a class="m-1 btn btnEditar" href="./editarEvento.php?idAct=<?php echo $mostrar['id_act'] ?>"> Editar</a>
                <?php
                if (strtotime($mostrar['fechaInicio']) > strtotime($fechaActualCom)){
                echo '<button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar'. $mostrar['id_act'] . '">Eliminar</button>';
                } else 
                { 
                echo '<button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar'. $mostrar['id_act'] . '"disabled>Eliminar</button>';

                }

                ?>

                <a class="m-1 btn btnInscritos" href="./inscritosEvento.php?idAct=<?php echo $mostrar['id_act'] ?>"> Inscritos</a>
              </div>
            </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="mEliminar<?php echo $mostrar['id_act'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Desea eliminar este evento?
                  <p> <b>-</b> <?php echo $mostrar['nombre_act'] . ', elaborado por ' . $mostrar['f_elab_por'] ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                  <form action="/proyectoGrupoScout/queries/enviarCorreosCancelacion.php" method="POST">
                    <input type="hidden" name="id_act" value="<?php echo $mostrar['id_act'] ?>" >
                    <input type="hidden" name="nombreAct" value="<?php echo $mostrar['nombre_act'] ?>" >
                    <button type="submit" name="eliminarEvento" class="btn links_nav">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        // echo "<tr>";
        // echo "<td colspan='6'>No hay eventos</td>";
        // echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php
require '../templates/scripts.php';

?>


<?php

echo $mensaje;

require '../templates/footer.php';

?>