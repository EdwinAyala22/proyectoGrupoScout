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

if (isset($_POST['crear'])) {
    $nombres = $_POST['nombres'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $tipodoc = $_POST['tipodoc'];
    $documento = $_POST['documento'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $eps = $_POST['eps'];
    $rh = $_POST['rh'];
    $genero = $_POST['genero'];
    $grupo_anterior = $_POST['grupo_anterior'];
    $ciudad = $_POST['ciudad'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $id_rama = $_POST['id_rama'];
    $id_rol = $_POST['id_rol'];

    $sql = "INSERT INTO usuarios (nombres, apellido1, apellido2, tipodoc, documento, fecha_nacimiento, telefono, direccion, eps, rh, genero, grupo_anterior, ciudad, correo, contrasena, id_rama, id_rol)  values ('$nombres','$apellido1','$apellido2','$tipodoc','$documento','$fecha_nacimiento','$telefono','$direccion','$eps','$rh','$genero','$grupo_anterior','$ciudad','$correo','$contrasena','$id_rama','$id_rol')";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        header("Location: /proyectoGrupoScout/views/admin/listUsers.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>

<title>Crear nuevo usuario</title>
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
            <h2 class="titulo fw-bold text-center py-3">Crear nuevo usuario</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/crearUsuario.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" title="Nombres" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido" title="Primer apellido" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido" title="Objetivo" required>
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione el tipo de documento">
                            <option disabled selected value>Tipo de Documento</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CC">Cédula de Ciudadania</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </div>
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" title="Número de documento" required>
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fecha_nacimiento" title="Fecha de nacimiento" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput"> <small>Fecha de nacimiento</small></label>
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="No. de celular" title="No. de celular" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="direccion" placeholder="Dirección" title="Dirección" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="eps" placeholder="Nombre EPS" title="Nombre EPS" required>
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="rh" title="Seleccione el tipo de sangre" required>
                            <option disabled selected value>RH</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="genero" title="Género" required>
                            <option disabled selected value>Género</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="grupo_anterior" placeholder="¿Grupo anterior?" title="¿Grupo anterior?" required>
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="ciudad" placeholder="Ciudad/municipio" title="Ciudad/municipio" required>
                    </div>
                    <div class="">
                        <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" title="Correo" required>
                    </div>
                    <div class="">
                        <input type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña" title="Contraseña" required>
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="id_rama" required title="Seleccione la rama">
                            <option disabled selected value>Seleccione la rama</option>
                            <option value="1">Lobatos</option>
                            <option value="2">Scouts</option>
                            <option value="3">Caminantes</option>
                            <option value="4">Rovers</option>
                            <option value="5">Dirigentes</option>
                            <option value="6">Consejeros</option>
                            <option value="7">Padres de familia</option>
                            <option value="8">Miembros fundadores</option>
                            <option value="9">Inactivos</option>
                            <option value="10">Otro</option>
                            <option value="11">No aplica</option>
                        </select>
                    </div>
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="id_rol" required title="Seleccione el rol">
                            <option disabled selected value>Seleccione el rol</option>
                            <option value="1">Admin</option>
                            <option value="2">Scout</option>
                            <option value="3">Visitante</option>
                        </select>
                    </div>
                </div>



                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="crear">Crear usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>