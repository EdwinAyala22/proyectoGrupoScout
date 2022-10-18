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
$query = "SELECT * FROM ramas";
$result_ramas = mysqli_query($conn, $query);


$consulta = 'SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.id_rol = 2';
$result = mysqli_query($conn, $consulta);


if (isset($_GET['delete'])) {
    $documento = $_GET['delete'];
    $query = "DELETE FROM usuarios WHERE documento = '$documento'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: /proyectoGrupoScout/views/admin/listUsers.php");
    } else {
        echo "Error";
    }
}


?>
<title>Usuarios</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
    <h1 class="titulo fw-bold text-center m-3">Lista de usuarios</h1>
    <div class="d-flex justify-content-start align-items-center gap-3">

        <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearUsuario.php/#newUser">Crear nuevo</a>
        <a target="_blank" class="mb-3 btn btnDetalles" href="/proyectoGrupoScout/views/reportes/r_usuarios.php">Reporte usuarios PDF</a>
        <div class="">
            <!--COMBO BOX RAMA -->
        <form action="../reportes/r_usuarios_ramas.php" class="d-flex justify-content-start align-items-center gap-2" method="POST" target="_blank">
            <select id="rama_progresion" class="form-select mb-3 fw-bold input_login" name="rama_progresion" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama">
                <option disabled selected value>Seleccionar rama</option>
                <?php
                while ($mostrar = mysqli_fetch_array($result_ramas)) { ?>
    
                    <option value="<?php echo $mostrar['id_rama']; ?>"><?php echo $mostrar['nom_rama']; ?></option>
    
    
                <?php
                }
                ?>
            </select>
    
            <button type="submit" class="btn btnDetalles" >Generar</button>
        </form>
    
        </div>
    </div>
        <table class="table table-borderless table-bordered">
            <thead class="cabeceraTablas text-center">
                <tr>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">T.D</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rama</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">

                <?php

                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['nombres'] ?></td>
                        <td><?php echo $mostrar['apellido1'] . ' ' . $mostrar['apellido2'] ?></td>
                        <td><?php echo $mostrar['tipodoc'] ?></td>
                        <td><?php echo $mostrar['documento'] ?></td>
                        <td><?php echo $mostrar['correo'] ?></td>
                        <td><?php echo $mostrar['nom_rama'] ?></td>
                        <td class="text-center">
                            <a class="m-1 btn btnDetalles" href="/proyectoGrupoScout/views/admin/detalleUsuario.php?det=<?php echo $mostrar['documento'] ?>">Detalles</a>
                            <a class="m-1 btn btnEditar" href="/proyectoGrupoScout/views/admin/editarUsuario.php?edit=<?php echo $mostrar['documento'] ?>">Editar</a>
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
                ?>
            </tbody>
        </table>
    </div>



    <?php

    require '../templates/footer.php';

    ?>