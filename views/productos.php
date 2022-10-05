<?php
$productos = array(
    "/proyectoGrupoScout/assets/img/accesorios.jpeg",
    "/proyectoGrupoScout/assets/img/gorras.jpeg",
    "/proyectoGrupoScout/assets/img/camping.jpeg",
    "/proyectoGrupoScout/assets/img/insignias.jpeg",
    "/proyectoGrupoScout/assets/img/gorras.jpeg",
    "/proyectoGrupoScout/assets/img/accesorios.jpeg",
    "/proyectoGrupoScout/assets/img/gorras.jpeg",
    "/proyectoGrupoScout/assets/img/camping.jpeg",
    "/proyectoGrupoScout/assets/img/insignias.jpeg",
    "/proyectoGrupoScout/assets/img/gorras.jpeg",
    "/proyectoGrupoScout/assets/img/accesorios.jpeg",
    "/proyectoGrupoScout/assets/img/camping.jpeg",
);
$nombreP = array(
    "Accesorios",
    "Gorras",
    "Camping",
    "Insignias",
    "Gorras",
    "Accesorios",
    "Gorras",
    "Camping",
    "Insignias",
    "Gorras",
    "Accesorios",
    "Camping",
);
$n = count($productos) - 1;
?>

<title>Contáctenos</title>
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


<div class="mt-3">
    <h1 class="fw-bold text-center titulo text-wrap">PRODUCTOS</h1>
</div>

<div class="container d-flex justify-content-center align-items-center flex-wrap">

    <?php
    for ($i = 0; $i <= $n; $i++) {
    ?>
        <div class="card card_productos text-center m-4" style="width: 18rem;">
            <img src="<?php echo $productos[$i] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title fw-bold" style="color: #1e0941;"><?php echo $nombreP[$i] ?></h5>
                <p class="card-text">Precio: <strong>$$$</strong> </p>
                <button type="submit" class="btn btn_general"> <strong>Más info...</strong></button>
            </div>
        </div>
    <?php } ?>

</div>

<div id="button-up">
    <i class="fas fa-chevron-up"></i>
</div>

<?php
require '../views/templates/footer.php';
?>