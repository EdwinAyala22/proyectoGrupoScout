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

if (isset($_POST['eliminar'])) {
  $documento = $_POST['documento'];
  $id_t_adelanto = $_POST['id_t_adelanto'];

  $query = "DELETE FROM segui_plan_adelanto WHERE documento = '$documento' AND id_t_adelanto = '$id_t_adelanto'";
  $resultado = mysqli_query($conn, $query);
  if ($resultado) {
    header("Location: /proyectoGrupoScout/views/admin/progresiones.php");
  } else {
    echo "Error";
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
  <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearPlandeProgresion.php">Crear nueva progresión</a>
  <table class="table table-borderless table-bordered" style="border-radius: 5px;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th scope="col">Rama</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Fecha Entrega</th>
        <th scope="col">Tipo de Adelanto</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr != 0) {

        while ($mostrar = mysqli_fetch_array($result)) {

      ?>

          <tr>
            <td><?php echo $mostrar['nom_rama'] ?>
            <td><?php echo $mostrar['nombres'] ?>
            <td><?php echo $mostrar['apellido1'] . ' ' . $mostrar['apellido2']  ?>
            <td><?php echo $mostrar['fechaEntrega'] ?>
            <td><?php echo $mostrar['nombreTipoAdelanto'] ?>
            <td class="d-flex justify-content-center align-items-center text-center">
              <form action="./detalleProgresion.php" method="POST" class="m-0">
                <input type="hidden" value="<?php echo $mostrar['documento'] ?>" name="documento">
                <input type="hidden" value="<?php echo $mostrar['id_t_adelanto'] ?>" name="id_t_adelanto">
                <button type="submit" class="btn btnDetalles m-1">Detalles</button>
              </form>

              <a class="m-1 btn btnEditar" href="./editarEvento.php?idAct=<?php echo $mostrar['documento'] ?>"> Editar</a>
              <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $mostrar['documento'].''.$mostrar['id_t_adelanto'] ?>">Eliminar</button>
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
        echo "<tr>";
        echo "<td colspan='6'>No hay progresiones realizadas</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php

require '../templates/footer.php';

?>