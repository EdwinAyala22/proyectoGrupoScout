<?php
session_start();

?>
<?php

include_once '../queries/database.php';

// $doc = $_POST['documento'];
// $cont =  $_POST['contrasena'];

if(isset($_GET['logout'])){
    session_unset();
    
    session_destroy();
    header("Location: ./login.php");
}

if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case 1:
            header("Location: ./admin/menuAdmin.php");
            break;
        case 2:
            header("Location: ./scouts/menuScout.php");
            break;
        default:
    }
}

if(isset($_POST['documento']) && isset($_POST['contrasena'])){
    $documento = $_POST['documento'];
    $contrasena =  $_POST['contrasena'];

    $db = new Database();
    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE documento =:documento AND contrasena =:contrasena');
    $query->execute(['documento' => $documento, 'contrasena' => $contrasena]);
    $row = $query->fetch(PDO::FETCH_NUM);
    if($row == true){
        //entro
        $rol = $row[16];
        $_SESSION['rol'] = $rol;
        switch($_SESSION['rol']){
            case 1:
                header("Location: /proyectoGrupoScout/views/admin/menuAdmin.php");
                break;
            case 2:
                header("Location: /proyectoGrupoScout/views/scouts/menuScout.php");
                break;
            default:
        }
    }else{
        echo '<script type="text/javascript">
        alert("Usuario o contraseña inválido");
        window.location.href="/proyectoGrupoScout/views/login.php";
        </script>';
    }

}

?>

<title>Login</title>
<?php
require '../views/templates/header.php';
?>

<div class="container w-75 mt-5 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-5">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-5">Iniciar Sesión</h2>
            <!-- formlario login -->

            <form action="" method="POST">

                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-user"></i>
                    <input type="number" class="form-control text-center fw-bold input_login" name="documento" placeholder="Usuario" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required autofocus maxlength="10" minlength="7">
                </div>
                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="form-control text-center fw-bold input_login" name="contrasena" placeholder="Contraseña" data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña" required maxlength="20" minlength="8">
                    <!-- <input type="hidden" value="modalUsu" name="idModal"> -->
                </div>
                <div class="mb-4 text-center">
                    <p class="titulo fst-italic">¿Olvidaste la contraseña? <a href="/proyectoGrupoScout/views/rcontra.php" class="titulo fw-bold link_login">Click aquí</a></p>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="btn btn_general">INGRESAR</button>
                </div>
                <div class="mb-4 text-center">
                    <p class="titulo fst-italic">¿No tienes una cuenta? <a href="/proyectoGrupoScout/views/register.php" class="titulo fw-bold link_login">Registrarse</a></p>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script> -->

<?php
require '../views/templates/footer.php';
?>