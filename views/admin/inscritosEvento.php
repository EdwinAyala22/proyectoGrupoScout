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
<title>Inscritos</title>
<?php


include_once '../../queries/conexion.php';

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listEventos.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">

  <h1 class="titulo fw-bold text-center m-3">Inscritos actividad</h1>

  <table class="table table-borderless table-bordered display responsive nowrap" id="tabla" style="width: 100%;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Correo</th>
      </tr>
    </thead>
    <tbody class="text-center">

      <?php



      if (isset($_GET['idAct'])) {
        $id_act = $_GET['idAct'];
        $sql = "SELECT * FROM inscritos  WHERE id_act = $id_act";
        $result = mysqli_query($conn, $sql);
        $nr = mysqli_num_rows($result);
        if ($nr != 0) {

          while ($row = mysqli_fetch_array($result)) {
            // $idAct = $row['id_act'];
      ?>
            <tr>
              <td><?php echo $row['documento'] ?></td>
              <td><?php echo $row['nombreC'] ?></td>
              <td><?php echo $row['correoIns'] ?></td>
            </tr>
      <?php
          }
        } else {
          // echo "<tr>";
          // echo "<td colspan='3'>No hay inscritos</td>";
          // echo "</tr>";
        }
      }

      ?>
    </tbody>
  </table>
</div>

<?php
require '../templates/scripts.php';
?>

<?php
require '../templates/footer.php';
?>