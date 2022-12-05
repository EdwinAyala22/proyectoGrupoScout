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

date_default_timezone_set('America/Bogota');
$fechaActual = date("Y-m-d");
$fechaLimite = date("Y-m-d",strtotime($fechaActual."- 5 year"));

$mensaje = "";
$tipoDeSangre = array(
    "A+",
    "A-",
    "B+",
    "B-",
    "AB+",
    "AB-",
    "O+",
    "O-"
);

$query = "SELECT * FROM ramas";
$result_ramas = mysqli_query($conn, $query);
$clase = "";

if (isset($_GET['edit'])) {
    $documento = $_GET['edit'];
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
        $idRol = $mostrar['id_rol'];
        $idRama = $mostrar['id_rama'];
    } else {
        // echo "Error";
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
            }
        });
        
    </script>';
    }
}else{
    $clase = "visually-hidden";
}

if (isset($_POST['editar'])) {
    $nombres = $_POST['nombres'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $tipodoc = $_POST['tipodoc'];
    $documento = $_GET['id'];
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
    $id_rol = $_POST['id_rol'];
    $id_rama = $_POST['id_rama'];

    $consulta = "UPDATE usuarios set nombres = '$nombres', apellido1 = '$apellido1', apellido2 = '$apellido2', tipodoc = '$tipodoc', documento = '$documento', fecha_nacimiento = '$fecha_nacimiento', telefono = '$telefono', direccion = '$direccion', eps = '$eps', rh = '$rh', genero = '$genero', grupo_anterior = '$grupo_anterior', ciudad = '$ciudad', correo = '$correo', contrasena = '$contrasena', id_rama = '$id_rama', id_rol = '$id_rol' WHERE documento = $documento";
    if (mysqli_query($conn, $consulta)) {
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Usuario actualizado!",
            "text": "El usuario ha sido actualizado con éxito.",
            "icon": "success",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#1e0941",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/admin/listUsers.php";
            }
        });
        
    </script>';
    } else {
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "text": "Error, inténtelo nuevamente.",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/admin/listUsers.php";
            }
        });
        
    </script>';
    }
}


?>

<title>Editar usuario</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2" id="newUser">Volver</a>

<div class="container w-100 mt-1 mb-5 container_general <?php echo $clase ?>">
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
            <h2 class="titulo fw-bold text-center py-3">Editar usuario</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/editarUsuario.php?id=<?php echo $doc ?>" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="nombres" class="form-label fw-bold titulo">Nombres: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" title="Nombres" required value="<?php echo $name ?>" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                    <div class="">
                        <label for="apellido1" class="form-label fw-bold titulo">Primer apellido: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido" title="Primer apellido" required value="<?php echo $ape1 ?>" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                    <div class="">
                        <label for="apellido2" class="form-label fw-bold titulo">Segundo apellido: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido" title="Segundo apellido" required value="<?php echo $ape2 ?>" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="tipodoc" class="form-label fw-bold titulo">Tipo de documento: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione el tipo de documento" required>
                            <option disabled value>Tipo de Documento</option>
                            <?php
                            switch ($tipoD) {
                                case 'TI':
                            ?>
                                    <option selected value="TI">Tarjeta de Identidad</option>
                                    <option value="CC">Cédula de Ciudadania</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                <?php
                                    break;
                                case 'CC':
                                ?>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option selected value="CC">Cédula de Ciudadania</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                <?php
                                    break;
                                case 'CE':
                                ?>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="CC">Cédula de Ciudadania</option>
                                    <option selected value="CE">Cédula de Extranjería</option>
                            <?php
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="documento" class="form-label fw-bold titulo">No. de documento: </label>
                        <input disabled type="number" class="form-control mb-3 fw-bold input_login validarNum" name="documento" placeholder="No. de documento" title="Número de documento" required value="<?php echo $doc ?>" minlength="7" maxlength="12">
                    </div>
                    <div class="">
                        <label for="fecha_nacimiento" class="form-label fw-bold titulo">Fecha de nacimiento: </label>
                        <input type="date" class="form-control mb-3 fw-bold input_login" name="fecha_nacimiento" placeholder="Fecha de nacimiento" title="Fecha de nacimiento" required value="<?php echo $f_nac ?>" max="<?php echo $fechaLimite ?>">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="telefono" class="form-label fw-bold titulo">Celular: </label>
                        <input type="number" class="form-control mb-3 fw-bold input_login validarNum" name="telefono" placeholder="No. de celular" title="No. de celular" required value="<?php echo $tel ?>" minlength="7" maxlength="10">
                    </div>
                    <div class="">
                        <label for="direccion" class="form-label fw-bold titulo">Dirección: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="direccion" placeholder="Dirección" title="Dirección" required value="<?php echo $dire ?>" minlength="4" maxlength="300">
                    </div>
                    <div class="">
                        <label for="eps" class="form-label fw-bold titulo">EPS: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="eps" placeholder="Nombre EPS" title="Nombre EPS" required value="<?php echo $ePS ?>" minlength="3" maxlength="200">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="rh" class="form-label fw-bold titulo">Tipo de sangre: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="rh" title="Seleccione el tipo de sangre" required>
                            <option disabled value>RH</option>
                            <?php
                            for ($i = 0; $i <= 8; $i++) {
                                if ($tipoDeSangre[$i] == $rH) {
                                    echo  '<option selected value="' . $tipoDeSangre[$i] . '">' . $tipoDeSangre[$i] . '</option>';
                                } else {
                                    echo  '<option value="' . $tipoDeSangre[$i] . '">' . $tipoDeSangre[$i] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="">
                        <label for="genero" class="form-label fw-bold titulo">Género: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="genero" title="Género" required>
                            <option disabled value>Género</option>
                            <?php
                            switch ($gender) {
                                case 'M':
                            ?>
                                    <option selected value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                <?php
                                    break;
                                case 'F':
                                ?>
                                    <option value="M">Masculino</option>
                                    <option selected value="F">Femenino</option>
                            <?php
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="grupo_anterior" class="form-label fw-bold titulo">¿Grupo anterior?: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="grupo_anterior" placeholder="¿Grupo anterior?" title="¿Grupo anterior?" required value="<?php echo $back_group ?>" minlength="2" maxlength="150" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <label for="ciudad" class="form-label fw-bold titulo">Ciudad: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="ciudad" placeholder="Ciudad/municipio" title="Ciudad/municipio" required value="<?php echo $ciu ?>" minlength="3" maxlength="100" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                    <div class="">
                        <label for="correo" class="form-label fw-bold titulo">Correo: </label>
                        <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" title="Correo" required value="<?php echo $email ?>" maxlength="50" pattern="[a-z0-9_]+([.][a-z0-9_]+)*@[a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{1,5}">
                    </div>
                    <div class="">
                        <label for="cpntrasena" class="form-label fw-bold titulo">Contraseña: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña" title="Contraseña" required value="<?php echo $pass ?>" minlength="8" maxlength="20">
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <label for="rama" class="form-label fw-bold titulo">Seleccionar rama: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="id_rama" required title="Seleccione la rama" required>
                            <option disabled value>Seleccione la rama</option>
                            <?php
                            while ($show_ramas = mysqli_fetch_array($result_ramas)) {
                                if ($show_ramas['id_rama'] === $idRama) {
                                    echo  '<option selected value="' . $show_ramas['id_rama'] . '">' . $show_ramas['nom_rama'] . '</option>';
                                } else {
                                    echo  '<option value="' . $show_ramas['id_rama'] . '">' . $show_ramas['nom_rama'] . '</option>';
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="rama" class="form-label fw-bold titulo">Seleccionar rol: </label>
                        <select class="form-select mb-3 fw-bold input_login" name="id_rol" required title="Seleccione el rol" required>
                            <option disabled value>Seleccione el rol</option>
                            <?php
                            switch ($idRol) {
                                case 1:
                            ?>
                                    <option selected value="1">Admin</option>
                                    <option value="2">Scout</option>
                                <?php
                                    break;
                                case 2:
                                ?>
                                    <option value="1">Admin</option>
                                    <option selected value="2">Scout</option>
                            <?php
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                </div>



                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="editar">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/scripts.php';

?>
<script lang="javascript">
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.oninput = () => {
            if (input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
        }
    });

    jQuery(document).ready(function() {
        jQuery('.validarNum').keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) {
                return false;
            }
        });
    });

</script>
<?php

echo $mensaje;

require '../templates/footer.php';

?>