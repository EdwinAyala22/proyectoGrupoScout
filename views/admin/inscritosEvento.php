<?php

session_start();

if (!isset($_SESSION['rol'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['rol'] != 1) {
    header("Location: ../login.php");
  }
}

?>
<title>Inscritos</title>
<?php

require '../templates/header.php';

include_once '../../queries/conexion.php';

if(isset($_GET['delete'])){
    $idAct= $_GET['delete'];
    $query = "DELETE FROM inscritos WHERE id_act = '$idAct'";
    $result = mysqli_query($conn,$query);
    if($result){
        header("Location: /proyectoGrupoScout/views/admin/inscritosEvento.php");
    }
    else{
        echo "Error";
    }
  }

$id_actividad= $_GET['idAct'];



?>

<div class="container d-flex justify-content-center mt-2 flex-wrap">

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

    

if(isset($_GET['idAct'])){
    $id_act= $_GET['idAct'];
    $sql = "SELECT * FROM inscritos  WHERE id_act = $id_act";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        while ($row = mysqli_fetch_array($result)) {
            // $idAct = $row['id_act'];
    ?>
        <tr>
            <td><?php echo $row['documento'] ?>
            <td><?php echo $row['nombreC'] ?>
            <td><?php echo $row['correoIns'] ?>
        </tr>
    </tbody>
    </table>
    <?php
  }
}else{
        echo "</br>";
        echo "</br>";
        echo "</br>";
        echo "<div class='row'><h4>No hay inscritos</h4></div>";
    }
}

    ?>

<button type="button" class="m-5 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $id_actividad ?>">Eliminar inscritos</button>

<!-- Modal -->
<div class="modal fade" id="mEliminar<?php echo $id_actividad ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ¿Desea eliminar todos los inscritos?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                <a href="/proyectoGrupoScout/views/admin/inscritosEvento.php?delete=<?php echo $id_actividad ?>" class="btn links_nav">Eliminar</a>
              </div>
            </div>
          </div>
        </div>

</div>


<?php
require '../templates/footer.php';
?>