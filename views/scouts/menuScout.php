<?php


session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION['rol'] != 2) {
        header("Location: ../login.php");
    }
}
?>

<title>Menú Scout</title>

<?php

require '../templates/header.php';
include_once '../../queries/conexion.php';



echo $_SESSION['id_user'];



?>

<h1 class="titulo fw-bold text-center mt-4 mb-1 text-uppercase">BIENVENIDO SCOUT</h1>

<!-- cards -->
<div class="container flex-wrap d-grid justify-content-center align-items-center ">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/scouts/perfilScout.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/Perfil.png" class="card-img-top mCardImg" alt="Eventos">
                </div>
                <div class="card-footer fw-bold">Perfil</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/scouts/scoutProgresiones.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/Progresion.png" class="card-img-top mCardImg" alt="Usuarios">
                </div>
                <div class="card-footer fw-bold">Mis progresiones</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/scouts/" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/educativa.png" class="card-img-top mCardImg" alt="Progresión Scout">
                </div>
                <div class="card-footer fw-bold">Información educativa</div>
            </div>
        </a>
    </div>
    <!-- <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="" class="card-img-top" alt="Reportes">
                </div>
                <div class="card-footer fw-bold">Reportes</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="" class="card-img-top" alt="Contactos">
                </div>
                <div class="card-footer fw-bold">Contactos</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="" class="card-img-top" alt="Contactos">
                </div>
                <div class="card-footer fw-bold">Contactos</div>
            </div>
        </a>
    </div> -->
</div>

<!-- <form method="POST" action="../login.php?logout=1">
    <button class="btn btn_general" type="submit">Cerrar sesión</button>
</form> -->

<?php

require '../templates/footer.php';

?>