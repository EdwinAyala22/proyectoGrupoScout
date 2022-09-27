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

<title>Menú Administrador</title>

<?php

require '../templates/header.php';

// $a_id = $_GET['a'];


?>

<h1 class="titulo fw-bold text-center mt-4 mb-1">BIENVENIDO</h1>


<!-- cards -->
<div class="container flex-wrap d-grid justify-content-center align-items-center ">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/admin/listEventos.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/eventosMenu.png" class="card-img-top mCardImg" alt="Eventos">
                </div>
                <div class="card-footer fw-bold">Eventos</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/listUsers.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/Usuarios.png" class="card-img-top mCardImg" alt="Usuarios">
                </div>
                <div class="card-footer fw-bold">Usuarios</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/progresiones.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="/proyectoGrupoScout/assets/img/Progresion.png" class="card-img-top mCardImg" alt="Progresión Scout">
                </div>
                <div class="card-footer fw-bold">Progresión Scout</div>
            </div>
        </a>
    </div>
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/graficas/graficas.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="/proyectoGrupoScout/assets/img/Reportes.png" class="card-img-top mCardImg" alt="Reportes">
                </div>
                <div class="card-footer fw-bold">Reportes</div>
            </div>
        </a>
        <a href="" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="/proyectoGrupoScout/assets/img/Perfil.png" class="card-img-top mCardImg" alt="Contactos">
                </div>
                <div class="card-footer fw-bold">Perfil</div>
            </div>
        </a>
        <a href="" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body">
                    <img src="/proyectoGrupoScout/assets/img/Contacto.png" class="card-img-top mCardImg" alt="Contactos">
                </div>
                <div class="card-footer fw-bold">Contactos</div>
            </div>
        </a>
    </div>
</div>

<form method="POST" action="/proyectoGrupoScout/views/login.php?logout=1">
    <button class="btn btn_general" type="submit">Cerrar sesión</button>
</form>

<?php

require '../templates/footer.php';

?>