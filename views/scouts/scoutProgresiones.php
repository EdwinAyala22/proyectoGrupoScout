<?php


session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION['rol'] != 2) {
        header("Location: ../login.php");
    }
}
?>
<title>Mis progresiones</title>

<?php

require '../templates/header.php';

include_once '../../queries/conexion.php';

$sid = $_SESSION['id_user'];

$sql = "SELECT * FROM segui_plan_adelanto AS s INNER JOIN tipodeadelanto AS t ON s.id_t_adelanto = t.id_t_adelanto INNER JOIN ramas AS r ON t.id_rama = r.id_rama INNER JOIN usuarios AS u ON s.documento = u.documento WHERE s.documento = $sid;";
$result = mysqli_query($conn, $sql);
$nr = mysqli_num_rows($result);

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-5 mt-5">
  <h1 class="titulo fw-bold text-center m-3">Mis progresiones</h1>
  <!-- <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearPlandeProgresion.php">Generar reportes</a> -->
  <table class="table table-borderless table-bordered" style="border-radius: 5px;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th scope="col">Rama</th>
        <th scope="col">Fecha Entrega</th>
        <th scope="col">Tipo de Adelanto</th>
        <th scope="col">Costo</th>
        <!-- <th scope="col">Acciones</th> -->
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr !=0 ){

        while ($mostrar = mysqli_fetch_array($result)) {

          ?>

        <tr>
          <td><?php echo $mostrar['nom_rama'] ?>
          <td><?php echo $mostrar['fechaEntrega'] ?>
          <td><?php echo $mostrar['nombreTipoAdelanto'] ?>
          <td><?php echo $mostrar['costo'] ?>
          <!-- <td class="text-center">
            <a class="m-1 btn btnDetalles" href="./detalleEvento.php?id="> Detalles</a>
            <a class="m-1 btn btnEditar" href="./editarEvento.php?idAct="> Editar</a>
            <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar">Eliminar</button>
          </td> -->
        </tr>
        <!-- Modal -->
        <?php
      } 
    } else {
      echo "<tr>";
      echo "<td colspan='6'>No tienes progresiones</td>";
      echo "</tr>";
    }
      ?>
    </tbody>
  </table>
</div>
<?php

require '../templates/footer.php';

?>