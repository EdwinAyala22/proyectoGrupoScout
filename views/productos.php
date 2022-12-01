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

<title>Productos</title>
<?php
session_start();

require '../views/templates/header.php';

// if (!isset($_SESSION['rol'])) {
//     $btn1 = $iniciarBtn;
//     $btn2 = $registrarBtn;
// } else {
//     $btn1 = $menuBtn;
//     $btn2 = $logoutBtn;
// }

?>


<div class="mt-4">
    <h1 class="fw-bold text-center titulo text-wrap">PRODUCTOS</h1>
</div>


<div class="container d-flex justify-content-center align-items-center flex-wrap mt-2 mb-4">

    <?php
    for ($i = 0; $i <= $n; $i++) {
    ?>
        <div class="card card_productos text-center mt-4 mb-5 ms-4 me-4" style="width: 14rem;">
            <img src="<?php echo $productos[$i] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title fw-bold" style="color: #1e0941;"><?php echo $nombreP[$i] ?></h5>
                <p class="card-text">Precio: <strong>$$$</strong> </p>
                <div class="d-flex justify-content-center">
                    <a href="https://api.whatsapp.com/send/?phone=%2B573209338469&text=Buenas,%20me%20interesa%20comprar%20este%20producto:%20<?php echo $nombreP[$i] ?>" target="_blank" class="btn btn_general d-flex justify-content-center align-items-center"> <strong>¡Comprar!</strong></a>
                </div>
            </div>
        </div>
    <?php } ?>

</div>



<?php
require '../views/templates/footer.php';
?>