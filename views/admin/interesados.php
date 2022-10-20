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


$consulta = 'SELECT * FROM visitantes';
$result = mysqli_query($conn, $consulta);
$nr = mysqli_num_rows($result);

if (isset($_GET['delete'])) {
    $documento = $_GET['delete'];
    $query = "DELETE FROM visitantes WHERE documento = '$documento'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: /proyectoGrupoScout/views/admin/listUsers.php");
    } else {
        echo "Error";
    }
}


?>
<title>Personas interesadas</title>

<?php

require '../templates/header.php';

?>


<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
    <h1 class="titulo fw-bold text-center m-3">Lista de personas interesadas</h1>
    <div class="d-flex justify-content-start align-items-center gap-3">

    </div>
        <table class="table table-borderless table-bordered">
            <thead class="cabeceraTablas text-center">
                <tr>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">T.D</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Correo</th>
                    <!-- <th scope="col">Rama</th> -->
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">

                <?php
if ($nr !=0 ){
                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['nombres'] ?></td>
                        <td><?php echo $mostrar['apellido1'] . ' ' . $mostrar['apellido2'] ?></td>
                        <td><?php echo $mostrar['tipodoc'] ?></td>
                        <td><?php echo $mostrar['documento'] ?></td>
                        <td><?php echo $mostrar['correo'] ?></td>
                        <!-- <td><?php echo $mostrar['nom_rama'] ?></td> -->
                        <td class="text-center">
                            
                            
                            <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $mostrar['documento'] ?>">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="mEliminar<?php echo $mostrar['documento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea eliminar este usuario?
                                    <p><?php echo $mostrar['nombres'] . ' ' . $mostrar['apellido1'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                                    <a href="/proyectoGrupoScout/views/admin/listUsers.php?delete=<?php echo $mostrar['documento'] ?>" class="btn links_nav">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<tr>";
                echo "<td colspan='6'>Por el momento, no hay personas interesadas en el Grupo</td>";
                echo "</tr>";
              }
                ?>
            </tbody>
        </table>
    </div>


<?php

require '../templates/footer.php';

?>