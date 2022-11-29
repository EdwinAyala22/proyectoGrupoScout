<title>Contáctenos</title>
<?php
session_start();

require_once '../queries/conexion.php';

$mensaje = "";

if (isset($_POST['pqrs'])) {
    $nombres = $_POST["nombres"];
    $correo = $_POST["correo"];
    $asunto = $_POST["asunto"];
    $detalles = $_POST["detalles"];

    $query = "INSERT INTO pqrs (nombres, correo, asunto, detalles) VALUES ('$nombres', '$correo', '$asunto', '$detalles')";

    if (mysqli_query($conn, $query)) {

        $mensaje = '<script lang="javascript">
        swal.fire({
            "title":"¡PQRS enviado!",
            "text": "El PQRS ha sido enviado con éxito.",
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
                window.location = "/proyectoGrupoScout/views/contacto.php";
            }
        });
        
    </script>';
    }
}

require '../views/templates/header.php';

?>

<div class="container w-75 mt-5 mb-5 container_general">
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
            <h2 class="titulo fw-bold text-center py-3 mt-5">Contáctenos</h2>
            <!-- formlario registro -->
            <form action="./contacto.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" required minlength="3" maxlength="100">
                    </div>
                    <div class="">
                        <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required>
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="asunto" placeholder="Asunto" data-bs-toggle="tooltip" data-bs-placement="top" title="Asunto" required minlength="6" maxlength="50" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+">
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <textarea class="form-control mb-3 fw-bold input_login" name="detalles" placeholder="Detalle..." title="Detalle..." required minlength="30" maxlength="800"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2 mt-3 mb-5">
                        <button type="submit" class="btn btn_general" name="pqrs">Enviar</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<?php 
require '../views/templates/scripts.php';
?>

<?php

echo $mensaje;

require '../views/templates/footer.php';
?>