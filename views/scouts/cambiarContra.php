<?php

session_start();


if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION['rol'] != 2) {
        header("Location: ../login.php");
    }
}


include_once '../../queries/conexion.php';

$class = "visually-hidden";
$error = "";

$documento = $_SESSION['id_user'];
// $documento = $_GET['id'];

// if (empty($documento)) {
//     header("Location: /proyectoGrupoScout/views/login.php");
// }


if (isset($_POST['cambiar'])) {
    $contrasena = $_POST['contrasena'];
    $nuevaContrasena = $_POST['nuevaContrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];

    $query = "SELECT contrasena FROM usuarios WHERE documento = $documento";
    $resultado = mysqli_query($conn, $query);
    $mostrar = mysqli_fetch_array($resultado);
    $queryContrasena = $mostrar['contrasena'];

    if ($contrasena === $queryContrasena) {

        if ($nuevaContrasena === $confirmarContrasena) {
            $queryCambiarContrasena = "UPDATE usuarios set contrasena = '$confirmarContrasena' WHERE documento = $documento";
            $resultadoCambiarContrasena = mysqli_query($conn, $queryCambiarContrasena);
            if ($resultadoCambiarContrasena) {
                echo '<script type="text/javascript">
                alert("La contraseña ha sido actualizada");
                window.location.href="/proyectoGrupoScout/views/login.php?logout=1";
                </script>';
            } else {
                $class = "alert alert-danger alert-dismissible fade show text-center";
                $error = "Error. Digite de nuevo los datos";
            }
        } else {
            $class = "alert alert-danger alert-dismissible fade show text-center";
            $error = "La nueva contraseña no coincide en ambos campos.";
        }
    } else {
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "Las contraseñas no coinciden.";
    }
}



?>
<title>Actualizar contraseña</title>
<?php
require '../templates/header.php';
?>


<a href="/proyectoGrupoScout/views/scouts/perfilScout.php" class="btn links_nav m-2">Volver</a>
<div class="container w-50 mt-5 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h1 class="titulo fw-bold text-center py-3">Actualizar contraseña</h1>
            <!-- formlario cambiar contraseña -->
            <form action="/proyectoGrupoScout/views/scouts/cambiarContra.php" method="POST" class="p-3 justify-content-center align-items-center">
                <div class="row">
                    <div class="">
                        <label for="contrasena" class="form-label fw-bold titulo">Contraseña anterior: </label>
                        <input id="contrasena" type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" title="Contraseña anterior" required minlength="8" autofocus>
                    </div>
                    <div class="">
                        <label for="nuevaContrasena" class="form-label fw-bold titulo">Nueva contraseña: </label>
                        <input id="nuevaContrasena" type="password" class="form-control mb-3 fw-bold input_login" name="nuevaContrasena" title="Nueva contraseña" minlength="8" required>
                    </div>
                    <div class="">
                        <label for="confirmarContrasena" class="form-label fw-bold titulo">Confirmar contraseña: </label>
                        <input id="confirmarContrasena" type="password" class="form-control mb-3 fw-bold input_login" name="confirmarContrasena" title="Confirmar contraseña" minlength="8" required>
                    </div>
                </div>
                <div class="<?php echo $class ?>" role="alert">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" name="cambiar" class="btn btn_general">Actualizar</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<?php
require '../templates/footer.php';
?>