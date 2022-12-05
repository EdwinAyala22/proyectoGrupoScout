<?php

session_start();

?>

<title>Recuperar Contraseña</title>
<?php
require '../views/templates/header.php';



include_once '../queries/conexion.php';



// if (!isset($_SESSION['rol'])) {
//     $btn1 = $iniciarBtn;
//     $btn2 = $registrarBtn;
// } else {
//     $btn1 = $menuBtn;
//     $btn2 = $logoutBtn;
// }

$mensaje = "";
$class = "visually-hidden";
$error = "";

if (isset($_POST['recuperar'])) {
    $documento = $_POST["documento"];
    $contrasena = $_POST["contrasena"];
    $correo = $_POST["correo"];

    $sql = "SELECT * FROM usuarios WHERE documento = '$documento' AND correo = '$correo'";
    $result = mysqli_query($conn, $sql);
    $nr = mysqli_num_rows($result);
    if ($nr != 0) {
        $sqlContra = "UPDATE usuarios SET contrasena = '$contrasena' WHERE documento = '$documento' AND correo = '$correo'";
        $resultContra = mysqli_query($conn, $sqlContra);
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Contraseña recuperada!",
            "text": "La contraseña se ha recuperado con éxito.",
            "icon": "success",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#1e0941",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/login.php/#theLogin";
            }
        });
        
    </script>';
        
    } else {
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "Usuario o correo incorrecto.";
    }
}


?>

<div class="container w-75 mt-5 mb-5 container_general">
    <div class="row align-items-stretch" id="rcontra">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-5">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-5">Recuperar contraseña</h2>
            <!-- formlario login -->

            <form action="./rcontra.php" method="POST">

                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-user"></i>
                    <input type="number" class="form-control text-center fw-bold input_login validarNum" name="documento" placeholder="Usuario" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required minlength="7" maxlength="12" autofocus>
                </div>
                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-envelope"></i>
                    <input type="email" class="form-control text-center fw-bold input_login" name="correo" placeholder="Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required pattern="[a-z0-9_]+([.][a-z0-9_]+)*@[a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{1,5}">
                </div>
                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="form-control text-center fw-bold input_login" name="contrasena" placeholder="Nueva contraseña" data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña" required minlength="8" maxlength="20">
                </div>
                <div class="<?php echo $class ?>" role="alert">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" name="recuperar" class="btn btn_general">Recuperar</button>
                </div>
                <div class="mb-4 text-center">
                    <p class="titulo fst-italic"> Volver a <a href="/proyectoGrupoScout/views/login.php/#theLogin" class="titulo fw-bold link_login">Inicio de sesión</a></p>
                </div>
            </form>

        </div>
    </div>
</div>

<?php

require '../views/templates/scripts.php'

?>
<script lang="javascript">
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.oninput = () => {
            if (input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
        }
    });

    jQuery(document).ready(function() {
        jQuery('.validarNum').keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) {
                return false;
            }
        });
    });

</script>
<?php

echo $mensaje;

require '../views/templates/footer.php';
?>