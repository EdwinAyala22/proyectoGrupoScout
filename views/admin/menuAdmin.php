<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION['rol'] != 1) {
        header("Location: ../login.php");
    }
}

?>

<title>Menú Administrador</title>

<?php

require '../templates/header.php';

?>

<h1>BIENVENIDO</h1>


<!-- cards -->
<div class="container flex-wrap d-grid justify-content-center align-items-center ">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Eventos">
                <div class="card-footer">Eventos</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/listUsers.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Usuarios">
                <div class="card-footer">Usuarios</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Progresión Scout">
                <div class="card-footer">Progresión Scout</div>
            </div>
        </a>
    </div>
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Reportes">
                <div class="card-footer">Reportes</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Contactos">
                <div class="card-footer ">Contactos</div>
            </div>
        </a>
        <a href="/proyectoGrupoScout/views/admin/crearEvento.php" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <img src="" class="card-img-top" alt="Contactos">
                <div class="card-footer">Contactos</div>
            </div>
        </a>
    </div>
</div>

<a href="/proyectoGrupoScout/views/admin/crearEvento.php"></a>
<form method="POST" action="../login.php?logout=1">
    <button class="btn btn_general" type="submit">Cerrar sesión</button>
</form>

<?php

require '../templates/footer.php';

?>