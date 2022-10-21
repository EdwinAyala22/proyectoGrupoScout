<title>Miembros scouts</title>
<?php
session_start();

require '../views/templates/header.php';

if (!isset($_SESSION['rol'])) {
    $btn1 = $iniciarBtn;
    $btn2 = $registrarBtn;
} else {
    $btn1 = $menuBtn;
    $btn2 = $logoutBtn;
}

?>

<div class="mt-4 mb-4">
    <h1 class="fw-bold text-center titulo text-wrap">MIEMBROS FUNDADORES Y CONSEJEROS</h1>
</div>

<div class="container-fluid mb-5 d-flex justify-content-center align-items-center flex-wrap">
    <div class="flip-card m-4" style="width: 15rem; height: 15rem;">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <img src="/proyectoGrupoScout/assets/img/consejero1.jpeg" class="card-img-top rounded" alt="...">
            </div>
            <div class="flip-card-back p-3 d-flex justify-content-center align-items-center text-center flex-wrap card-body">
                <div class="text-start">
                    <p class="titulo"><strong>Nombre: </strong><small>Eduardo Lopez</small></p>
                    <p class="titulo"><strong>Cargo: </strong><small>un cargo</small></p>
                    <p class="titulo"><strong>Correo: </strong><small>eduardo@gmail.com</small></p>
                </div>
            </div>
        </div>
    </div>

    <div class="flip-card m-4" style="width: 15rem; height: 15rem;">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <img src="/proyectoGrupoScout/assets/img/consejero2.jpeg" class="card-img-top rounded" alt="...">
            </div>
            <div class="flip-card-back p-3 d-flex justify-content-center align-items-center text-center flex-wrap card-body">
                <div class="text-start">
                    <p class="titulo"><strong>Nombre: </strong><small>Eduardo Lopez</small></p>
                    <p class="titulo"><strong>Cargo: </strong><small>un cargo</small></p>
                    <p class="titulo"><strong>Correo: </strong><small>eduardo@gmail.com</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="flip-card m-4" style="width: 15rem; height: 15rem;">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <img src="/proyectoGrupoScout/assets/img/consejero3.jpeg" class="card-img-top rounded" alt="...">
            </div>
            <div class="flip-card-back p-3 d-flex justify-content-center align-items-center text-center flex-wrap card-body">
                <div class="text-start">
                    <p class="titulo"><strong>Nombre: </strong><small>Eduardo Lopez</small></p>
                    <p class="titulo"><strong>Cargo: </strong><small>Lider Scout</small></p>
                    <p class="titulo"><strong>Correo: </strong><small>eduardo@gmail.com</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="flip-card  m-4" style="width: 15rem; height: 15rem;">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <img src="/proyectoGrupoScout/assets/img/consejero1.jpeg" class="card-img-top rounded" alt="...">
            </div>
            <div class="flip-card-back p-3 d-flex justify-content-center align-items-center text-center flex-wrap card-body">
                <div class="text-start">
                    <p class="titulo"><strong>Nombre: </strong><small>Eduardo Lopez</small></p>
                    <p class="titulo"><strong>Cargo: </strong><small>un cargo</small></p>
                    <p class="titulo"><strong>Correo: </strong><small>eduardo@gmail.com</small></p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- <a href="mailto:e22ayalarecalde@gmail.com">Aquí el texto que quieras</a> -->

<?php
require '../views/templates/footer.php';
?>