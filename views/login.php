<?php
session_start();

?>
<?php

include_once '../queries/database.php';

$class = "visually-hidden";
$error = "";

if (isset($_GET['logout'])) {
    session_unset();

    session_destroy();
    header("Location: /proyectoGrupoScout/views/login.php/#theLogin");
}

if (isset($_SESSION['rol'])) {
    $doc = $_POST['documento'];
    $cont =  $_POST['contrasena'];
    switch ($_SESSION['rol']) {
        case 1:
            header("Location: /proyectoGrupoScout/views/admin/menuAdmin.php");

            break;
        case 2:
            header("Location: /proyectoGrupoScout/views/scouts/menuScout.php");
            break;
        default:
    }
}

if (isset($_POST['documento']) && isset($_POST['contrasena'])) {
    $documento = $_POST['documento'];
    $contrasena =  $_POST['contrasena'];

    $db = new Database();
    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE documento =:documento AND contrasena =:contrasena');
    $query->execute(['documento' => $documento, 'contrasena' => $contrasena]);
    $row = $query->fetch(PDO::FETCH_NUM);
    if ($row == true) {
        //entro
        $rol = $row[16];
        $_SESSION['rol'] = $rol;
        switch ($_SESSION['rol']) {
            case 1:
                
                $menuBtn = '<a href="/proyectoGrupoScout/views/login.php" class="btn links_nav me-2" style="display: <?php echo $btnInicio ?>;" >Menú</a>';
                $logoutBtn = '<form method="POST" action="/proyectoGrupoScout/views/login.php?logout=1">
                <button class="btn btn_general" type="submit">Cerrar sesión</button>
                </form>';
                header("Location: /proyectoGrupoScout/views/admin/menuAdmin.php");
                $_SESSION['id_user'] = $documento;
                break;
            case 2:
                $menuBtn = '<a href="/proyectoGrupoScout/views/login.php" class="btn links_nav me-2" style="display: <?php echo $btnInicio ?>;" >Menú</a>';
                $logoutBtn = '<form method="POST" action="/proyectoGrupoScout/views/login.php?logout=1">
                <button class="btn btn_general" type="submit">Cerrar sesión</button>
                </form>';
                header("Location: /proyectoGrupoScout/views/scouts/menuScout.php");
                $_SESSION['id_user'] = $documento;
                break;
            default:
        }
    } else {
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "Usuario o contraseña incorrecta.";
    }
}

?>

<title>Login</title>
<?php
require '../views/templates/header.php';
?>
<div id="theLogin"></div>

<div class="container col-md-7 col-sm-8 mt-5 mb-5 container_general" >
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
                    <input type="number" class="form-control text-center fw-bold input_login" name="documento" placeholder="Usuario" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento"  autofocus maxlength="10" minlength="7"required>
                </div>
                <div class="mb-4 iconos_login">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="form-control text-center fw-bold input_login" name="contrasena" placeholder="Contraseña" data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña"  maxlength="20" minlength="8" required>
                    <!-- <input type="hidden" value="modalUsu" name="idModal"> -->
                </div>
                <div class="<?php echo $class ?>" role="alert">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="mb-4 text-center">
                    <p class="titulo fst-italic">¿Olvidaste la contraseña? <a href="/proyectoGrupoScout/views/rcontra.php" class="titulo fw-bold link_login">Click aquí</a></p>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="btn btn_general">INGRESAR</button>
                </div>
                <!-- <div class="mb-4 text-center">
                    <p class="titulo fst-italic">¿No tienes una cuenta? <a href="/proyectoGrupoScout/views/register.php" class="titulo fw-bold link_login">Registrarse</a></p>
                </div> -->
            </form>

        </div>
    </div>
</div>



<?php
require '../views/templates/footer.php';
?>