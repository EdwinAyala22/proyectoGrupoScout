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

$consulta = 'SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.id_rol = 3';
$result = mysqli_query($conn, $consulta);


if (isset($_GET['delete'])) {
    $documento = $_GET['delete'];
    $query = "DELETE FROM usuarios WHERE documento = '$documento'";
    $result = mysqli_query($conn, $query);
    if ($result) {

        header("Location: /proyectoGrupoScout/views/admin/listUsers.php");
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
                window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
            }
        });
        
    </script>';
    }
}


?>
<title>Interesados</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
    <h1 class="titulo fw-bold text-center m-3">Lista de personas interesadas</h1>
    
    <table class="table table-borderless table-bordered display responsive nowrap" id="tabla" style="width: 100%;">
        <thead class="cabeceraTablas text-center">
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>T.D</th>
                <th>Documento</th>
                <th>Correo</th>
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
                    <td class="text-center">
                        <a class="m-1 btn btnDetalles" href="/proyectoGrupoScout/views/admin/detalleUsuario.php?det=<?php echo $mostrar['documento'] ?>">Detalles</a>
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
                                ¿Desea eliminar esta persona interesada en el grupo?
                                <p><?php echo $mostrar['nombres'] . ' ' . $mostrar['apellido1'].' '.$mostrar['apellido2'] ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                                <a href="/proyectoGrupoScout/views/admin/interesados.php?delete=<?php echo $mostrar['documento'] ?>" class="btn links_nav">Eliminar</a>
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