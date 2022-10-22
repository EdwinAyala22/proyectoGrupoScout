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

<?php

include_once '../../queries/conexion.php';

$documento = $_POST['documento'];
$id_t_adelanto = $_POST['id_t_adelanto'];

$query = "SELECT * FROM usuarios U, segui_plan_adelanto S, tipodeadelanto T WHERE U.documento = S.documento AND S.id_t_adelanto = T.id_t_adelanto AND S.documento = $documento AND S.id_t_adelanto = $id_t_adelanto";
$result = mysqli_query($conn, $query);
$nr = mysqli_num_rows($result);

$mostrar = mysqli_fetch_array($result);

// print_r($mostrar);


?>

<title>Detalle Progresión</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/progresiones.php" class="btn links_nav m-2">Volver</a>
<div class="container w-75 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Detalle seguimiento plan de adelanto</h2>
            <!-- formlario registro -->
            <form class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label for="nombres" class="form-label fw-bold titulo">Nombres: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" placeholder="Nombres" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" required value="<?php echo $mostrar['nombres'] ?>" readonly>
                    </div>
                    <div class="">
                        <label for="apellido1" class="form-label fw-bold titulo">Apellido: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellidos" placeholder="Apellidos" data-bs-toggle="tooltip" data-bs-placement="top" title="Apellidos" required value="<?php echo $mostrar['apellido1'] ?>" readonly>
                    </div>

                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label for="documento" class="form-label fw-bold titulo">No. de documento: </label>
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required value="<?php echo $mostrar['documento'] ?>" readonly>
                    </div>
                    <div class="">
                        <label for="fechaEntrega" class="form-label fw-bold titulo">Fecha de entrega: </label>
                        <input type="date" class="form-control mb-3 fw-bold input_login" name="fechaEntrega" placeholder="Fecha de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha de entrega" required value="<?php echo $mostrar['fechaEntrega'] ?>" readonly>
                        <!-- <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha de entrega </label> -->
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <!--COMBO BOX RAMA -->
                        <label for="rama_progresion" class="form-label fw-bold titulo">Rama: </label>

                        <select id="rama_progresion" class="form-select mb-3 fw-bold input_login" name="rama_progresion" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama" disabled>
                            <option disabled>Seleccionar rama</option>
                            <?php
                            $sql = "SELECT * FROM ramas";
                            $resultado = mysqli_query($conn, $sql);
                            $idRama = $mostrar['id_rama'];

                            while ($ver = mysqli_fetch_array($resultado)) {

                                if ($ver['id_rama'] == $idRama) {
                                    echo '<option value="' . $ver["id_rama"] . '"selected > ' . $ver["nom_rama"] . '</option>';
                                } else {

                            ?>

                                    <option value="<?php echo $ver['id_rama']; ?>"><?php echo $ver['nom_rama']; ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="">
                        <label for="tipoDeAdelanto" class="form-label fw-bold titulo">Tipo de adelanto: </label>

                        <select id="" class="form-select mb-3 fw-bold input_login" name="id_t_adelanto" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione el tipo de seguimiento" disabled>
                            <!-- <option disabled >Seleccionar progresión</option> -->
                            <option value="<?php echo $mostrar['id_t_adelanto'] ?>"> <?php echo $mostrar['nombreTipoAdelanto'] ?> </option>
                        </select>
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label for="lugarEntrega" class="form-label fw-bold titulo">Lugar de entrega: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugarEntrega" placeholder="Lugar de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Lugar de entrega" required value="<?php echo $mostrar['lugarEntrega'] ?>" readonly>
                    </div>
                    <div class="">
                        <label for="dirigente" class="form-label fw-bold titulo">Dirigente a cargo: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="dirigente" placeholder="Dirigente a cargo" data-bs-toggle="tooltip" data-bs-placement="top" title="Dirigente a cargo" required value="<?php echo $mostrar['dirigente'] ?>" readonly>
                    </div>
                </div>

                <div class="row ">
                    <div class="">
                        <label for="costo" class="form-label fw-bold titulo">Costo: </label>
                        <input type="Number" class="form-control mb-3 fw-bold input_login" name="costo" placeholder="Costo" data-bs-toggle="tooltip" data-bs-placement="top" title="Costo" required value="<?php echo $mostrar['costo'] ?>" readonly>
                    </div>
                </div>

                <!-- <div class="row">
                        <div class="col d-flex justify-content-center align-items-center p-2">
                            <button type="submit" name="crearP" class="btn btn_general">Crear seguimiento</button>
                        </div>
                    </div> -->
            </form>
        </div>
    </div>
</div>


<?php

require '../templates/footer.php';

?>