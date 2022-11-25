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

require '../templates/header.php';

include_once '../../queries/conexion.php';
?>

<a href="/proyectoGrupoScout/views/admin/listEventos.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container d-flex justify-content-center mt-2 mb-5 flex-wrap bg-light p-3 containerCrud mb-3">

  <div class="row">
    <h1 class="titulo fw-bold">Inscritos actividad</h1>
  </div>

  <table class="table table-borderless table-bordered" style="border-radius: 5px;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th scope="col">Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
      </tr>
    </thead>
    <tbody class="text-center">

      <?php



      if (isset($_GET['idAct'])) {
        $id_act = $_GET['idAct'];
        $sql = "SELECT * FROM inscritos  WHERE id_act = $id_act";
        $result = mysqli_query($conn, $sql);
        $nr = mysqli_num_rows($result);
        if ($nr !=0 ) {

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
          echo "<tr>";
          echo "<td colspan='3'>No hay inscritos</td>";
          echo "</tr>";
        }
      }

      ?>
    </tbody>
  </table>
</div>

<?php
require '../templates/footer.php';
?>