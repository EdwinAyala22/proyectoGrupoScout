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
<title>Plan de progresión</title>
<?php

include_once '../../queries/conexion.php';

$mensaje = "";

$query = "SELECT * FROM ramas";
$result = mysqli_query($conn, $query);

if (isset($_POST['crearP'])) {
    $fechaEntrega = $_POST['fechaEntrega'];
    $doc = $_POST['documento'];
    $id_adelanto = $_POST['id_t_adelanto'];
    $lugarEntrega = $_POST['lugarEntrega'];
    $dirigente = $_POST['dirigente'];
    $costo = $_POST['costo'];

    $sql = "SELECT * FROM usuarios WHERE documento = '$doc'";
    $rs = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($rs);
    if ($rows != 1) {
        
        $mensaje = '<script lang="javascript">
            swal.fire({
                "title":"¡Error!",
                "icon": "error",
                "text": "Error, el usuario no existe.",
                "confirmButtonText": "Aceptar",
                "confirmButtonColor": "#ed1b25",
                "allowOutsideClick": false,
                "allowEscapeKey" : false
            }).then((result)=>{
                if (result.isConfirmed){
                    window.location = "/proyectoGrupoScout/views/admin/crearPlandeProgresion.php";
                }
            });
            
        </script>';
    } else {
        $sql2 = "SELECT * FROM segui_plan_adelanto WHERE documento = '$doc'";
        $rs2 = mysqli_query($conn, $sql2);
        // $mostrarU = mysqli_fetch_array($rs2);
        $mismoAdelanto = "0";
        while ($mostrarU = mysqli_fetch_array($rs2)) {
            if ($mostrarU['id_t_adelanto'] == $id_adelanto) {
                $mismoAdelanto = 1;
            }
        }

        if ($mismoAdelanto == 0){

        $consulta = "INSERT INTO segui_plan_adelanto (fechaEntrega, documento, id_t_adelanto, lugarEntrega, dirigente, costo) VALUES ('$fechaEntrega', '$doc', '$id_adelanto', '$lugarEntrega', '$dirigente', '$costo')";
        if (mysqli_query($conn, $consulta)) {
            
            $mensaje = '<script lang="javascript">
                swal.fire({
                    "title":"¡Progresión creada!",
                    "text": "La progresión ha sido creada con éxito.",
                    "icon": "success",
                    "confirmButtonText": "Aceptar",
                    "confirmButtonColor": "#1e0941",
                    "allowOutsideClick": false,
                    "allowEscapeKey" : false
                }).then((result)=>{
                    if (result.isConfirmed){
                        window.location = "/proyectoGrupoScout/views/admin/progresiones.php";
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
                            window.location = "/proyectoGrupoScout/views/admin/crearPlandeProgresion.php";
                        }
                    });
                    
                </script>';
        }
    } else {
        $mensaje = '<script lang="javascript">
                    swal.fire({
                        "title":"¡Error!",
                        "icon": "error",
                        "text": "Error, el scout ya tiene esta progresión.",
                        "confirmButtonText": "Aceptar",
                        "confirmButtonColor": "#ed1b25",
                        "allowOutsideClick": false,
                        "allowEscapeKey" : false
                    }).then((result)=>{
                        if (result.isConfirmed){
                            window.location = "/proyectoGrupoScout/views/admin/crearPlandeProgresion.php";
                        }
                    });
                    
                </script>';
    }
    }
}

require '../templates/header.php';


?>

<script lang="javascript">
    $(document).ready(function() {
        $("#rama_progresion").change(function() {
            $("#rama_progresion option:selected").each(function() {
                id_rama = $(this).val();
                $.post("/proyectoGrupoScout/queries/getTipoProgresiones.php", {
                    id_rama: id_rama
                }, function(data) {
                    $("#progresion-seleccionada").html(data);
                });
            });
        });
    });
</script>
<a href="/proyectoGrupoScout/views/admin/progresiones.php" class="btn links_nav m-2">Volver</a>
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
            <h2 class="titulo fw-bold text-center py-3">Formulario seguimiento a planes de progresión y ceremonias</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/crearPlandeProgresion.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" minlength="3" maxlength="40" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellidos" placeholder="Apellidos" data-bs-toggle="tooltip" data-bs-placement="top" title="Apellidos" minlength="3" maxlength="40" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>

                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login validarNum" name="documento" placeholder="No. de documento" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" minlength="7" maxlength="12" required>
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control mb-3 fw-bold input_login" name="fechaEntrega" placeholder="Fecha de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha de entrega" required>
                        <label class="ms-2 fw-bold titulo" for="floatingInput">Fecha de entrega </label>
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <!--COMBO BOX RAMA -->
                        <select id="rama_progresion" class="form-select mb-3 fw-bold input_login" name="rama_progresion" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama" required>
                            <option disabled selected value>Seleccionar rama</option>
                            <?php
                            while ($mostrar = mysqli_fetch_array($result)) { ?>

                                <option value="<?php echo $mostrar['id_rama']; ?>"><?php echo $mostrar['nom_rama']; ?></option>


                            <?php
                            }
                            ?>
                        </select>

                    </div>

                    <div class="" id="progresion-seleccionada">
                        <!-- COMBOBOX PROGRESIÓN-->
                        <!-- <select id="progresion-seleccionada" class="form-select mb-3 fw-bold input_login" name="progresion-seleccionada" required data-bs-toggle="tooltip" data-bs-placement="top" title="Progresión">
                                
                                
                            
                            </select> -->

                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugarEntrega" placeholder="Lugar de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Lugar de entrega" minlength="3" maxlength="100" required>
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="dirigente" placeholder="Dirigente a cargo" data-bs-toggle="tooltip" data-bs-placement="top" title="Dirigente a cargo" minlength="3" maxlength="100" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                    </div>
                </div>

                <div class="row ">
                    <div class="">
                        <input type="Number" class="form-control mb-3 fw-bold input_login validarNum" name="costo" placeholder="Costo" data-bs-toggle="tooltip" data-bs-placement="top" title="Costo" maxlength="10" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" name="crearP" class="btn btn_general">Crear seguimiento</button>
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