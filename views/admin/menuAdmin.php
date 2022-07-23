<?php


session_start();

if(!isset($_SESSION['rol'])){
    header("Location: ../login.php");
}else{
    if($_SESSION['rol'] != 1 ){
        header("Location: ../login.php");
    }
}

?>


<title>Administrador</title>

<?php

require '../templates/header.php';

?>

<h1>BIENVENIDO</h1>
<a href="/proyectoGrupoScout/views/admin/crearEvento.php">Crear evento</a>
<form method="POST" action="../login.php?logout=1">
    <button class="btn btn_general" type="submit">Cerrar sesión</button>
</form>