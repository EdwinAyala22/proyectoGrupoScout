<?php

$btnInicio = "block";
$btnRegistro = "Registrarse";

$iniciarBtn = '<a href="/proyectoGrupoScout/views/login.php/#theLogin" class="btn links_nav me-2" style="display: <?php echo $btnInicio ?>;" >Iniciar Sesión</a>';
$registrarBtn = '<a href="/proyectoGrupoScout/views/register.php" class="btn links_nav">Registro<?php echo $btnRegistro ?></a>';

$menuBtn = '<a href="/proyectoGrupoScout/views/login.php" class="btn links_nav me-2" style="display: <?php echo $btnInicio ?>;" >Menú</a>';
$logoutBtn = '<form method="POST" action="/proyectoGrupoScout/views/login.php?logout=1" class="mb-0">
            <button class="btn links_nav me-2" type="submit">Cerrar sesión</button>
            </form>';


$btn1 = "";
$btn2 = "";

// session_start();

if (!isset($_SESSION['rol'])) {
    $btn1 = $iniciarBtn;
    $btn2 = $registrarBtn;
} else {
    $btn1 = $menuBtn;
    $btn2 = $logoutBtn;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     -->

    <!-- Estilos de Bootstrap 5.1.3  -->
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/lib/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/lib/DataTables/DataTables-1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/lib/DataTables/Responsive-2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/lib/DataTables/Responsive-2.4.0/css/responsive.dataTables.min.css">


    <!-- Estilos de la página web  -->
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/css/style.css">
    <link rel="shortcut icon" href="/proyectoGrupoScout/assets/img/logo-scout-co.svg" type="image/x-icon">
    
    <!-- Estilos de sweet alert  -->
    <link rel="stylesheet" href="/proyectoGrupoScout/assets/lib/SweetAlert2/dist/sweetalert2.min.css">

    <!-- Estilos de las gráficas  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/b333d707bf.js" crossorigin="anonymous"></script>

    <!-- JQuery  -->
    <script lang="javascript" src="/proyectoGrupoScout/assets/js/jquery-3.6.0.min.js"></script>
    <title>Inicio</title>

</head>

<body>
<div class="container-fluid nav_scout d-flex pt-2 w-100 justify-content-center" id="nav">
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 w-100">
            <div class="pt-2">
                <a href="" class="text-white text-decoration-none titulo_nav"><img src="/proyectoGrupoScout/assets/img/LOGOOO-SINTXT.png" alt="" width="100" class="img-fluid nav_logo">Grupo Scout 662 León Blanco</a>
            </div>
            <div class="text-center d-flex m-auto pt-2">
                <a href="/proyectoGrupoScout/views/productos.php" class="text-light nav-link m-auto productos_nav"> <i class="fas fa-shopping-cart me-1"></i> Productos Scout</a>
            </div>
            <div class="col-md-12 text-md-center d-flex justify-content-lg-end align-items-lg-center justify-content-md-center align-items-md-center pt-2 botones_nav mb-2">
                <?php echo $btn1 ?>
                <?php echo $btn2 ?>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark nav_scout" >
        
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <h6 class="text-white">Grupo Scout 662</h6>
                <h6 class="text-white">León Blanco</h6>
                <img src="./img/LOGOOO-SINTXT.png" alt="" width="100" class="img-fluid nav_logo"> -->
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-center" href="/proyectoGrupoScout/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="/proyectoGrupoScout/#qs">¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="/proyectoGrupoScout/views/actividades.php">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="/proyectoGrupoScout/views/miembros.php">Miembros scouts</a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Miembros scouts
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-center" href="/proyectoGrupoScout/views/contacto.php">Contáctenos</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link fas fa-map-marker-alt" href="https://goo.gl/maps/3xtKRSvRhEG4kThS8" target="blank"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>