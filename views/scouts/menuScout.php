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


?>

<h1 class="titulo fw-bold text-center mt-4 mb-1 text-uppercase">BIENVENIDO SCOUT</h1>

<!-- cards -->
<div class="container flex-wrap d-grid justify-content-center align-items-center mb-5 mt-5">
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
        <a data-bs-toggle="modal" data-bs-target="#informacionEducativa" class="text-decoration-none btnAdmin">
            <div class="card cardAdmin text-center m-3">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="/proyectoGrupoScout/assets/img/educativa.png" class="card-img-top mCardImg" alt="Progresión Scout">
                </div>
                <div class="card-footer fw-bold">Información educativa</div>
            </div>
        </a>

    </div>

</div>
<div class="modal fade" id="informacionEducativa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titulo fw-bold" id="exampleModalLabel">Información Educativa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>ficha médica</b></a>
                        </div>
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>formato de inscripción</b></a>
                        </div>
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>formato de permiso</b></a>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>plan de grupo</b></a>
                        </div>
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>ciclo del programa</b></a>
                        </div>
                        <div class="row mb-2">
                            <a href="" class="titulo fst-italic link_login">Ver <b>malla de objetivos</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_general p-1" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>