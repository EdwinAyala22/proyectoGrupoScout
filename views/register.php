<?php

session_start();

?>

<?php

include_once '../queries/conexion.php';

date_default_timezone_set('America/Bogota');
$fechaActual = date("Y-m-d");
$fechaLimite = date("Y-m-d",strtotime($fechaActual."- 5 year"));

$mensaje = "";

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

    $sql_verificar_existe = "SELECT * FROM usuarios WHERE documento = $documento";
    $resultado_sql_v_e = mysqli_query($conn, $sql_verificar_existe);
    $filas_sql_v_e = mysqli_num_rows($resultado_sql_v_e);
    if ($filas_sql_v_e) {
        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Error!",
            "icon": "error",
            "text": "Error, usted ya se encuentra registrado",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#ed1b25",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/views/register.php";
            }
        });
        
    </script>';
    } else {
        $sql = "INSERT INTO usuarios (nombres, apellido1, apellido2, tipodoc, documento, fecha_nacimiento, telefono, direccion, eps, rh, genero, grupo_anterior, ciudad, correo, contrasena, id_rama, id_rol)  values ('$nombres','$apellido1','$apellido2','$tipodoc','$documento','$fecha_nacimiento','$telefono','$direccion','$eps','$rh','$genero','$grupo_anterior','$ciudad','$correo','$contrasena','$id_rama','$id_rol')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            
            $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡Registro realizado!",
            "text": "Su registro se ha realizado con éxito, por favor espere información por parte del grupo para la activación de su usuario",
            "icon": "success",
            "confirmButtonText": "Aceptar",
            "confirmButtonColor": "#1e0941",
            "allowOutsideClick": false,
            "allowEscapeKey" : false
        }).then((result)=>{
            if (result.isConfirmed){
                window.location = "/proyectoGrupoScout/";
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
                window.location = "/proyectoGrupoScout/views/register.php";
            }
        });
        
    </script>';
        }
    }
}



?>
<title>Registro</title>
<?php
require '../views/templates/header.php';
?>


<div class="container w-100 mt-5 mb-5 container_general">
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
            <h1 class="titulo fw-bold text-center py-3">¡Quiero ser scout!</h1>
            <div class="row">
                <p class="text-wrap text-center tituloRojo fst-italic fw-bold text-interesado">¡Si te interesa hacer parte de esta grandiosa familia, regístrate y nosotros nos pondremos en contacto contigo!</p>
            </div>
            <!-- formlario registro -->
            <form action="./register.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" title="Nombres" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido" title="Primer apellido" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido" title="Segundo apellido" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione el tipo de documento" required>
                            <option disabled selected value>Tipo de Documento</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CC">Cédula de Ciudadania</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </div>
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" title="Número de documento" minlength="7" maxlength="10" pattern="[0-9]" required>
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control mb-3 fw-bold input_login" id="floatingInput" name="fecha_nacimiento" title="Fecha de nacimiento" max="<?php echo $fechaLimite ?>" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput"> <small>Fecha de nacimiento</small></label>
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="No. de celular" title="No. de celular" minlength="7" maxlength="15" pattern="[0-9]" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="direccion" placeholder="Dirección" title="Dirección" minlength="4" maxlength="300" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="eps" placeholder="Nombre EPS" title="Nombre EPS" minlength="3" maxlength="200" required>
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
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="grupo_anterior" placeholder="¿Grupo anterior?" title="¿Grupo anterior?" minlength="2" maxlength="150" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="ciudad" placeholder="Ciudad/municipio" title="Ciudad/municipio" minlength="3" maxlength="100" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" title="Correo" maxlength="50" required>
                    </div>
                    <div class="">
                        <input type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña" title="Contraseña" minlength="8" maxlength="20" required>
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <input type="hidden" class="form-control mb-3 fw-bold input_login" name="id_rama" value="9">
                    <input type="hidden" class="form-control mb-3 fw-bold input_login" name="id_rol" value="3">
                </div>



                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" class="btn btn_general" name="crear">Registrarme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../views/templates/scripts.php'

?>

<?php

echo $mensaje;

require '../views/templates/footer.php';
?>