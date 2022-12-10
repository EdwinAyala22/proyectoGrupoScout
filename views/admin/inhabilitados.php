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
date_default_timezone_set('America/Bogota');
$query = "SELECT * FROM ramas";
$result_ramas = mysqli_query($conn, $query);
$mensaje = "";
$fechaActual = date("Y-m-d");

$consulta = 'SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.id_rol = 4';
$result = mysqli_query($conn, $consulta);


if (isset($_POST['habilitar'])) {

    $doc = $_POST['documento'];
    $idRama = $_POST['id_rama'];
    $nuevoRol = 2;

    $sql_v_doc = "SELECT * FROM usuarios WHERE documento = $doc";
    $result_sql_v_doc = mysqli_query($conn, $sql_v_doc);
    $nr = mysqli_num_rows($result_sql_v_doc);

    if ($nr != 0) {
        $sql_h_usu = "UPDATE usuarios set id_rama = '$idRama', id_rol = '$nuevoRol' WHERE documento = $doc";
        $result_sql_h_usu = mysqli_query($conn, $sql_h_usu);
        if ($result_sql_h_usu) {
            $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Usuario habilitado!",
            "text": "El usuario ha sido habilitado con éxito",
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
                window.location = "/proyectoGrupoScout/views/admin/inhabilitados.php";
            }
        });
        
    </script>';
        }
    } else {
        $mensaje = '<script lang="javascript">
    swal.fire({
        "title":"¡El documento no existe!",
        "icon": "warning",
        "confirmButtonText": "Aceptar",
        "confirmButtonColor": "#1e0941",
        "allowOutsideClick": false,
        "allowEscapeKey" : false
    }).then((result)=>{
        if (result.isConfirmed){
            window.location = "/proyectoGrupoScout/views/admin/inhabilitados.php";
        }
    });
    
</script>';
    }
}


?>
<title>Inhabilitados</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2">Volver</a>

<div class="container bg-light p-3 containerCrud mb-3">
    <h1 class="titulo fw-bold text-center m-3">Lista de Scouts Inhabilitados</h1>

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
                // $nacimiento = new DateTime($mostrar['fecha_nacimiento']);
                // $actual = new DateTime($fechaActual);

                // $edad = $actual->diff($nacimiento);
                // echo $edad->format("%y");
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
                        <button type="button" class="m-1 btn btnSolucionar" data-bs-toggle="modal" data-bs-target="#mHabilitar<?php echo $mostrar['documento'] ?>">Habilitar</button>
                    </td>
                </tr>
                
                <!-- Modal -->
                <div class="modal fade" id="mHabilitar<?php echo $mostrar['documento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="./inhabilitados.php" method="POST">
                                    <label for="hab" class="form-label fw-bold titulo">Por favor asigne una rama al usuario que desea habilitar:</label>
                                    <p class="titulo"> <b>Nombre:</b> <?php echo $mostrar['nombres'] . ' ' . $mostrar['apellido1'] . ' ' . $mostrar['apellido2'] ?></p>
                                    <!-- <p class="titulo"> <b>Edad:</b> </p> -->
                                    <select id="rama" class="form-select fw-bold input_login" name="id_rama" data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama" required>
                                        <option disabled selected value>Seleccionar rama</option>
                                        <option value="1">Lobatos</option>
                                        <option value="2">Scouts</option>
                                        <option value="3">Caminantes</option>
                                        <option value="4">Rovers</option>
                                        <option value="5">Dirigentes</option>
                                        <option value="6">Consejeros</option>
                                        <option value="7">Padres de familia</option>
                                        <option value="8">Miembros fundadores</option>
                                        <option value="9">Inactivos</option>
                                        <option value="10">Otro</option>
                                        <option value="11">No aplica</option>
                                    </select>
                                    <input type="hidden" name="documento" value="<?php echo $mostrar['documento'] ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btnSolucionar" name="habilitar" >Habilitar</button>
                            </div>
                            </form>
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