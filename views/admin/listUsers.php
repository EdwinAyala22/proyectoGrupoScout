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
$mensaje = "";

$consulta = 'SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.id_rol = 2';
$result = mysqli_query($conn, $consulta);


if (isset($_POST['inhabilitar'])) {
    $documento = $_POST['documento'];
    $newRol = 4;
    $newRama = 9;
    $query = "UPDATE usuarios set id_rol = '$newRol', id_rama = '$newRama' WHERE documento = '$documento'";
    $result_inh = mysqli_query($conn, $query);
    if ($result_inh) {

        // header("Location: /proyectoGrupoScout/views/admin/listUsers.php");
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Usuario Inhabilitado!",
            "text": "El usuario ha sido inhabilitado con éxito.",
            "icon": "success",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#1e0941",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/admin/listUsers.php";
            }
        });
        
    </script>';
    } else {
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/admin/listUsers.php";
            }
        });
        
    </script>';
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
    <div class="d-flex justify-content-start align-items-center flex-wrap gap-3">

        <a class="mb-3 btn crearNuevo" href="/proyectoGrupoScout/views/admin/crearUsuario.php/#newUser">Crear nuevo</a>
        <a target="_blank" class="mb-3 btn btnDetalles" href="/proyectoGrupoScout/views/reportes/r_usuarios.php">Reporte usuarios PDF</a>
        <div class="">
            <!--COMBO BOX RAMA -->
            <form action="../reportes/r_usuarios_ramas.php" class="d-flex justify-content-start align-items-center gap-2" method="POST" target="_blank">
                <select id="rama_progresion" class="form-select fw-bold input_login" name="rama_progresion" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama">
                    <option disabled selected value>Seleccionar rama</option>
                    <?php
                    while ($mostrar = mysqli_fetch_array($result_ramas)) { ?>

                        <option value="<?php echo $mostrar['id_rama']; ?>"><?php echo $mostrar['nom_rama']; ?></option>


                    <?php
                    }
                    ?>
                </select>

                <button type="submit" class="btn btnDetalles">Generar</button>
            </form>

        </div>
        <a href="/proyectoGrupoScout/views/admin/interesados.php" class="btn btnDetalles mb-3">Interesados</a>
        <a href="/proyectoGrupoScout/views/admin/inhabilitados.php" class="btn btnDetalles mb-3">Inhabilitados</a>
    </div>
    <table class="table table-borderless table-bordered display responsive nowrap" id="tabla" style="width: 100%;">
        <thead class="cabeceraTablas text-center">
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>T.D</th>
                <th>Documento</th>
                <th>Correo</th>
                <th>Rama</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">

            <?php

            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td>
                        <p></p> <?php echo $mostrar['nombres'] ?>
                    </td>
                    <td>
                        <p></p> <?php echo $mostrar['apellido1'] . ' ' . $mostrar['apellido2'] ?>
                    </td>
                    <td>
                        <p></p> <?php echo $mostrar['tipodoc'] ?>
                    </td>
                    <td>
                        <p></p> <?php echo $mostrar['documento'] ?>
                    </td>
                    <td>
                        <p></p> <?php echo $mostrar['correo'] ?>
                    </td>
                    <td>
                        <p></p> <?php echo $mostrar['nom_rama'] ?>
                    </td>
                    <td class="text-center">
                        <a class="m-1 btn btnDetalles" href="/proyectoGrupoScout/views/admin/detalleUsuario.php?det=<?php echo $mostrar['documento'] ?>">Detalles</a>
                        <a class="m-1 btn btnEditar" href="/proyectoGrupoScout/views/admin/editarUsuario.php?edit=<?php echo $mostrar['documento'] ?>">Editar</a>
                        <button type="button" class="m-1 btn btnEliminar" data-bs-toggle="modal" data-bs-target="#mEliminar<?php echo $mostrar['documento'] ?>">Inhabilitar</button>
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
                                ¿Desea inhabilitar este usuario?
                                <p> <b>-</b> <?php echo $mostrar['nombres'] . ' ' . $mostrar['apellido1'] ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                                <form action="./listUsers.php" method="POST">
                                    <input type="hidden" name="documento" value="<?php echo $mostrar['documento'] ?>">
                                    <button type="submit" name="inhabilitar" class="btn links_nav">Inhabilitar</button>
                                </form>
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
require '../templates/scripts.php';

?>


<?php

echo $mensaje;

require '../templates/footer.php';

?>