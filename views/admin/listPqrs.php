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

$pqrs = "SELECT * FROM pqrs ORDER BY estado ASC";
$result = mysqli_query($conn, $pqrs);
$nr = mysqli_num_rows($result);

if (isset($_GET['edit'])) {
  $idPQRS = $_GET['edit'];
  $query = "UPDATE pqrs set estado = 1 WHERE id_pqrs = $idPQRS";
  $result2 = mysqli_query($conn, $query);
  if ($result2) {
    header("Location: /proyectoGrupoScout/views/admin/listPqrs.php");
  }else {
      echo "Error";
    }
  } 

$bmA = '<button type="button" class="m-1 btn btnEditar" data-bs-toggle="modal" data-bs-target="#mEstado<?php echo $mostrar["id_pqrs"] ?>">Cambiar estado</button>';

?>

<title>Lista PQRS</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
  <h1 class="titulo fw-bold text-center m-3">Lista de PQRS</h1>

  <div class="d-flex fw-bold  justify-content-center text-center m-3">
  <div><i class="bi bi-x-square-fill" style="color:red;"></i> = Sin solucionar</div>  
  <div class="ms-2"><i class=" bi bi-check-square-fill" style="color:green;"></i> = Solucionado</div>
  </div>

  <table class="table table-borderless table-bordered" style="border-radius: 5px;">
    <thead class="cabeceraTablas text-center">
      <tr>
        <th scope="col">Asunto</th>
        <th scope="col">Nombre</th>
        <th scope="col">Fecha</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      if ($nr !=0 ){

        while ($mostrar = mysqli_fetch_array($result)) {
            
          ?>

        <tr>
          <td><?php echo $mostrar['asunto'] ?>
          <td><?php echo $mostrar['nombres'] ?>
          <td><?php echo $mostrar['fechaRegistro'] ?>
          <?php 
          if ( $mostrar['estado'] == 0){
            echo '<td> <i class="bi bi-x-square-fill" style="color:red;"></i>';
            } else {
                echo '<td> <i class="bi bi-check-square-fill" style="color:green;"></i>';
            }?>
          <td class="d-flex justify-content-center align-items-center text-center">
            
            <button type="button" class="btn btnDetalles m-1" data-bs-toggle="modal" data-bs-target="#details<?php echo $mostrar['id_pqrs'] ?>">Detalles</button>
            <?php if ( $mostrar['estado'] == 0){ 
                echo '<button type="button" class="m-1 btn btnEditar" data-bs-toggle="modal" data-bs-target="#mEstado' . $mostrar['id_pqrs'] . '">Cambiar estado</button>';
            } else {
                echo '<button type="button" class="m-1 btn btnEditar" data-bs-toggle="modal" data-bs-target="#mEstado' . $mostrar['id_pqrs'] . '" disabled>Cambiar estado</button>';
            } ?>

                  <form action="./solucionPqrs.php" method="POST" class="m-0">
                    <input type="hidden" value="<?php echo $mostrar['nombres'] ?>" name="nombres">
                    <input type="hidden" value="<?php echo $mostrar['correo'] ?>" name="correo">
                    <button type="submit" class="btn btnSolucionar m-1" name="solucionar">Responder</button>
                  </form>
          </td>
        </tr>

        <!-- Modal Detalles-->
        <div class="modal fade" id="details<?php echo $mostrar['id_pqrs'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Detalles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

              <section class="mt5 mb-5">
    <div class="container m-1 m-d-flex p-2 flex-wrap">
      
        <div class="row">
            <div class="col-3">
                <p class="fw-bold my-1 text-end">Nombres:</p>
            </div>

            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['nombres'] ?> </p>
            </div>

        </div>
        
        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Correo:</p>
            </div>
    
            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['correo'] ?> </p>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Estado:</p>
            </div>
    
            <div class="col-9">
            <?php if ( $mostrar['estado'] == 0){
            echo '<p class="my-1">Sin solucionar</P> ';
            } else {
                echo '<p class="my-1">Solucionado</P> ';
            }?>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Fecha:</p>
            </div>
    
            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['fechaRegistro'] ?> </p>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Asunto:</p>
            </div>
    
            <div class="col-9">
                <p class="my-1 text_home"> <?php echo $mostrar['asunto'] ?> </p>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Detalles:</p>
            </div>
    
            <div class="col-9">
                <p class="my-1 text_home"> <?php echo $mostrar['detalles'] ?> </p>
            </div>
        </div>
        </div>
    </section>
    </div>

              <div class="modal-footer">
                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Editar-->
        <div class="modal fade" id="mEstado<?php echo $mostrar['id_pqrs'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                ¿Está seguro que el siguiente PQRS se ha solucionado?
                <div class="container m-1 m-d-flex p-2 flex-wrap">
      

                <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Fecha:</p>
            </div>
    
            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['fechaRegistro'] ?> </p>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <p class="fw-bold my-1 text-end">Nombres:</p>
            </div>

            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['nombres'] ?> </p>
            </div>

        </div>
        
        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Correo:</p>
            </div>
    
            <div class="col-9">
            <p class="my-1"> <?php echo $mostrar['correo'] ?> </p>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-end">
                <p class="fw-bold my-1 text-end">Asunto:</p>
            </div>
    
            <div class="col-9">
                <p class="my-1 text_home"> <?php echo $mostrar['asunto'] ?> </p>
            </div>
        </div>
        </div>
            
        <div class="fs-6 fw-light">
            <span class="fw-bold">NOTA:</span> Al dar click en el botón "confirmar" el estado se cambiará a "Solucionado" y NO se podrá deshacer.

        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                <a href="/proyectoGrupoScout/views/admin/listPqrs.php?edit=<?php echo $mostrar['id_pqrs'] ?>" class="btn links_nav">Confirmar</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      } 
    } else {
      echo "<tr>";
      echo "<td colspan='6'>No hay PQRS</td>";
      echo "</tr>";
    }
      ?>
    </tbody>
  </table>
</div>

<?php

require '../templates/footer.php';

?>