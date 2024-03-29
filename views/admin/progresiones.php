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

<title>Progresiones</title>

<?php



include_once '../../queries/conexion.php';

$mensaje = "";

if (isset($_POST['eliminar'])) {
  $documento = $_POST['documento'];
  $id_t_adelanto = $_POST['id_t_adelanto'];

  $query = "DELETE FROM segui_plan_adelanto WHERE documento = '$documento' AND id_t_adelanto = '$id_t_adelanto'";
  $resultado = mysqli_query($conn, $query);
  if ($resultado) {
    header("Location: /proyectoGrupoScout/views/admin/progresiones.php");
  } else {
    // echo "Error";
    $mensaje = '<script lang="javascript">
    swal.fire({
        "title":"¡Error!",
        "text": "Error, intente nuevamente.",
        "icon": "error",
        "confirmButtonText": "Aceptar",
        "confirmButtonColor": "#ed1b25",
        "allowOutsideClick": false,
        "allowEscapeKey" : false
    }).then((result)=>{
        if (result.isConfirmed){
            window.location = "/proyectoGrupoScout/views/admin/progresiones.php";
        }
    });
    
</script>';
  }
}


require '../templates/header.php';



$sql = 'SELECT * FROM segui_plan_adelanto S, tipodeadelanto T, ramas R, usuarios U WHERE S.documento = U.documento AND S.id_t_adelanto = T.id_t_adelanto AND T.id_rama = R.id_rama';
$result = mysqli_query($conn, $sql);
$nr = mysqli_num_rows($result);



?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
  <h1 class="titulo fw-bold text-center m-3">Lista de progresiones</h1>
  <div class="d-flex justify-content-start align-items-center gap-3">
    <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearPlandeProgresion.php">Crear nueva progresión</a>
  </div>
  <table class="table table-borderless table-bordered display responsive nowrap" style="width: 100%;" id="tabla">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th>Rama</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha Entrega</th>
        <th>Tipo de Adelanto</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr != 0) {

        while ($mostrar = mysqli_fetch_array($result)) {

      ?>

          <tr>
            <td><p></p><?php echo $mostrar['nom_rama'] ?></td>
            <td><p></p><?php echo $mostrar['nombres'] ?></td>
            <td><p></p><?php echo $mostrar['apellido1'] . ' ' . $mostrar['apellido2']  ?></td>
            <td><p></p><?php echo $mostrar['fechaEntrega'] ?></td>
            <td><p></p><?php echo $mostrar['nombreTipoAdelanto'] ?></td>
            <td>
              <div class="d-flex justify-content-center">

                <form action="./detalleProgresion.php" method="POST" class="m-0">
                  <input type="hidden" value="<?php echo $mostrar['documento'] ?>" name="documento">
                  <input type="hidden" value="<?php echo $mostrar['id_t_adelanto'] ?>" name="id_t_adelanto">
                  <button type="submit" class="btn btnDetalles m-1">Detalles</button>
                </form>
                <form action="./editarProgresion.php" method="POST" class="m-0">
                  <input type="hidden" value="<?php echo $mostrar['documento'] ?>" name="documento">
                  <input type="hidden" value="<?php echo $mostrar['id_t_adelanto'] ?>" name="id_t_adelanto">
                  <button type="submit" class="btn btnEditar m-1">Editar</button>
                </form>
                
                <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $mostrar['documento'].''.$mostrar['id_t_adelanto'] ?>">Eliminar</button>
                
              </div>
            </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="mEliminar<?php echo $mostrar['documento'].''.$mostrar['id_t_adelanto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Desea eliminar esta progresión?
                  
                  <p><?php echo $mostrar['nombreTipoAdelanto'].' de '.$mostrar['nombres'] . ' ' . $mostrar['apellido1'] ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                  <form action="./progresiones.php" method="POST">
                    <input type="hidden" value="<?php echo $mostrar['documento'] ?>" name="documento">
                    <input type="hidden" value="<?php echo $mostrar['id_t_adelanto'] ?>" name="id_t_adelanto">
                    <button type="submit" class="btn links_nav" name="eliminar">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        // echo "<tr>";
        // echo "<td colspan='6'>No hay progresiones realizadas</td>";
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