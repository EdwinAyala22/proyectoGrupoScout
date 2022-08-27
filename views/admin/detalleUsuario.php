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
<?php

include_once '../../queries/conexion.php';


if (isset($_GET['det'])) {
    $documento = $_GET['det'];
    $query = "SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.documento = $documento";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $mostrar = mysqli_fetch_array($result);
        $name = $mostrar['nombres'];
        $ape1 = $mostrar['apellido1'];
        $ape2 = $mostrar['apellido2'];
        $tipoD = $mostrar['tipodoc'];
        $doc = $mostrar['documento'];
        $f_nac = $mostrar['fecha_nacimiento'];
        $tel = $mostrar['telefono'];
        $dire = $mostrar['direccion'];
        $ePS = $mostrar['eps'];
        $rH = $mostrar['rh'];
        $gender = $mostrar['genero'];
        $back_group = $mostrar['grupo_anterior'];
        $ciu = $mostrar['ciudad'];
        $email = $mostrar['correo'];
        $pass = $mostrar['contrasena'];
        $rama = $mostrar['nom_rama'];
        $rol = $mostrar['rol'];
    } else {
        echo "Error";
    }
}

?>

<title>Detalle</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container w-100 mt-1 mb-5 container_general">
    <div class="row align-items-stretch">
        <div class="col m-auto d-none d-lg-block col-md-4 col-lg-4 col-xl-5">
            <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
        </div>
        <div class="col p-3">
            <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                <div class="">
                    <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                </div>
            </div>
            <h2 class="titulo fw-bold text-center py-3">Detalle usuario</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/listUsers.php?edit=<?php echo $doc ?>" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="nombres" class="form-label fw-bold titulo">Nombres: </label>
                        <input disabled id="nombres" type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" title="Nombres" required value="<?php echo $name ?>">
                    </div>
                    <div class="">
                        <label for="apellido1" class="form-label fw-bold titulo">Primer apellido: </label>
                        <input disabled id="apellido1" type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido" title="Primer apellido" required value="<?php echo $ape1 ?>">
                    </div>
                    <div class="">
                        <label for="apellido2" class="form-label fw-bold titulo">Segundo apellido: </label>
                        <input disabled id="apellido2" type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido" title="Segundo apellido" required value="<?php echo $ape2 ?>">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="tipodoc" class="form-label fw-bold titulo">Tipo de documento: </label>
                        <input disabled id="tipodoc" type="text" class="form-control mb-3 fw-bold input_login" name="tipodoc" placeholder="Tipo de documento" title="Tipo de documento" required value="<?php echo $tipoD ?>">
                    </div>
                    <div class="">
                        <label for="documento" class="form-label fw-bold titulo">No. de documento: </label>
                        <input disabled id="documento" type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" title="Número de documento" required value="<?php echo $doc ?>">
                    </div>
                    <div class="">
                        <label for="fecha_nacimiento" class="form-label fw-bold titulo">Fecha de nacimiento: </label>
                        <input disabled id="fecha_nacimiento" type="date" class="form-control mb-3 fw-bold input_login" name="fecha_nacimiento" placeholder="Fecha de nacimiento" title="Fecha de nacimiento" required value="<?php echo $f_nac ?>">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="telefono" class="form-label fw-bold titulo">Celular: </label>
                        <input disabled id="telefono" type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="No. de celular" title="No. de celular" required value="<?php echo $tel ?>">
                    </div>
                    <div class="">
                        <label for="direccion" class="form-label fw-bold titulo">Dirección: </label>
                        <input disabled id="direccion" type="text" class="form-control mb-3 fw-bold input_login" name="direccion" placeholder="Dirección" title="Dirección" required value="<?php echo $dire ?>">
                    </div>
                    <div class="">
                        <label for="eps" class="form-label fw-bold titulo">EPS: </label>
                        <input disabled id="eps" type="text" class="form-control mb-3 fw-bold input_login" name="eps" placeholder="Nombre EPS" title="Nombre EPS" required value="<?php echo $ePS ?>">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="rh" class="form-label fw-bold titulo">Tipo de sangre: </label>
                        <input disabled id="rh" type="text" class="form-control mb-3 fw-bold input_login" name="rh" placeholder="Tipo de sangre" title="Tipo de sangre" required value="<?php echo $rH ?>">
                    </div>
                    <div class="">
                        <label for="genero" class="form-label fw-bold titulo">Género: </label>
                        <input disabled id="genero" type="text" class="form-control mb-3 fw-bold input_login" name="genero" placeholder="Género" title="Género" required value="<?php echo $gender ?>">
                    </div>
                    <div class="">
                        <label for="grupo_anterior" class="form-label fw-bold titulo">¿Grupo anterior?: </label>
                        <input disabled id="grupo_anterior" type="text" class="form-control mb-3 fw-bold input_login" name="grupo_anterior" placeholder="¿Grupo anterior?" title="¿Grupo anterior?" required value="<?php echo $back_group ?>">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="ciudad" class="form-label fw-bold titulo">Ciudad: </label>
                        <input disabled id="ciudad" type="text" class="form-control mb-3 fw-bold input_login" name="ciudad" placeholder="Ciudad/municipio" title="Ciudad/municipio" required value="<?php echo $ciu ?>">
                    </div>
                    <div class="">
                        <label for="correo" class="form-label fw-bold titulo">Correo: </label>
                        <input disabled id="correo" type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" title="Correo" required value="<?php echo $email ?>">
                    </div>
                    <div class="">
                        <label for="contrasena" class="form-label fw-bold titulo">Contrasena: </label>
                        <input disabled id="contrasena" type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña" title="Contraseña" required value="<?php echo $pass ?>">
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label for="rama" class="form-label fw-bold titulo">Rama: </label>
                        <input disabled id="rama" type="text" class="form-control mb-3 fw-bold input_login" name="rama" placeholder="Rama" title="Rama" required value="<?php echo $rama ?>">
                    </div>
                    <div class="">
                        <label for="rol" class="form-label fw-bold titulo">Rol: </label>
                        <input disabled id="rol" type="text" class="form-control mb-3 fw-bold input_login" name="rol" placeholder="Rol" title="Rol" required value="<?php echo $rol ?>">
                    </div>
                </div>



                <!-- <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="editar">Volver</button>
                    </div>
                </div> -->
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>