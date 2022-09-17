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

$evento = "SELECT * FROM f_actividades A, ramas R WHERE A.id_rama = R.id_rama";
$result = mysqli_query($conn, $evento);
$nr = mysqli_num_rows($result);

if (isset($_GET['delete'])) {
  $idAct = $_GET['delete'];
  $query = "DELETE FROM inscritos WHERE id_act = '$idAct'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $query2 = "DELETE FROM f_actividades WHERE id_act = '$idAct'";
    $result2 = mysqli_query($conn, $query2);
    if ($result2) {
      header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
    } else {
      echo "Error";
    }
  } 
  // else {
  //   $query2 = "DELETE FROM f_actividades WHERE id_act = '$idAct'";
  //   $result2 = mysqli_query($conn, $query2);
  //   if ($result2) {
  //     header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
  //   } else {
  //     echo "Error";
  //   }
  // }
}

// if (isset($_GET['delete'])) {
//   $id_act = $_GET['delete'];
//   $query2 = "DELETE FROM f_actividades WHERE id_act = '$id_act'";
//   $result2 = mysqli_query($conn, $query2);
//   if ($result2) {
//     header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
//   } else {
//     echo "Error";
//   }
// }

?>

<title>Eventos</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
  <h1 class="titulo fw-bold text-center m-3">Lista de eventos</h1>
  <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearEvento.php">Crear nuevo</a>
  <table class="table table-borderless table-bordered" style="border-radius: 5px;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Lugar</th>
        <th scope="col">Costo</th>
        <th scope="col">Fecha-Inicio</th>
        <th scope="col">Fecha-Fin</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr !=0 ){

        while ($mostrar = mysqli_fetch_array($result)) {

          ?>

        <tr>
          <td><?php echo $mostrar['nombre_act'] ?>
          <td><?php echo $mostrar['lugar'] ?>
          <td>$<?php echo $mostrar['costo'] ?>
          <td><?php echo $mostrar['fechaInicio'] ?>
          <td><?php echo $mostrar['fechaFin'] ?>
          <td class="text-center">
            <a class="m-1 btn btnDetalles" href="./detalleEvento.php?id=<?php echo $mostrar['id_act'] ?>"> Detalles</a>
            <a class="m-1 btn btnEditar" href="./editarEvento.php?idAct=<?php echo $mostrar['id_act'] ?>"> Editar</a>
            <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $mostrar['id_act'] ?>">Eliminar</button>
            <a class="m-1 btn btnInscritos" href="./inscritosEvento.php?idAct=<?php echo $mostrar['id_act'] ?>"> Inscritos</a>
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
                <p><?php echo $mostrar['nombre_act'] . ', ' . $mostrar['f_elab_por'] ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                <a href="/proyectoGrupoScout/views/admin/listEventos.php?delete=<?php echo $mostrar['id_act'] ?>" class="btn links_nav">Eliminar</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      } 
    } else {
      echo "<tr>";
      echo "<td colspan='6'>No hay eventos</td>";
      echo "</tr>";
    }
      ?>
    </tbody>
  </table>
</div>

<?php

require '../templates/footer.php';

?>