<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: /proyectoGrupoScout/views/login.php");
} else {
    if ($_SESSION['rol'] != 1) {
        header("Location: /proyectoGrupoScout/views/login.php");
    }
}

include_once '../../queries/conexion.php';
$documento = $_POST['documento'];
$id_t_adelanto = $_POST['id_t_adelanto'];
// $nombres = $_POST['nombres'];
// $apellidos = $_POST['apellidos'];

if (isset($_POST['editarP'])) {
    $fechaEntrega = $_POST['fechaEntrega'];
    $idAdeAnterior = $_POST['idAdelantoAnterior'];
    $lugar = $_POST['lugarEntrega'];
    $dirigente = $_POST['dirigente'];
    $costo = $_POST['costo'];
    $queryU = "UPDATE segui_plan_adelanto set fechaEntrega = '$fechaEntrega', id_t_adelanto = '$id_t_adelanto', lugarEntrega = '$lugar', dirigente = '$dirigente', costo = '$costo'   WHERE documento = $documento AND id_t_adelanto = '$idAdeAnterior'";
    $resultU = mysqli_query($conn, $queryU);
     if ($resultU){
        echo'<script type="text/javascript">
                alert("La progresión se ha modificado con éxito.");
                window.location.href="/proyectoGrupoScout/views/admin/progresiones.php";
                </script>';
     } else {
        echo "Error al tratar de modificar la progresión.";
     }
}

 

    
    
    

$query1 = "SELECT * FROM usuarios U, segui_plan_adelanto S, tipodeadelanto T WHERE U.documento = S.documento AND S.id_t_adelanto = T.id_t_adelanto AND S.documento = $documento AND S.id_t_adelanto = $id_t_adelanto";
$result1 = mysqli_query($conn, $query1);
$nr = mysqli_num_rows($result1);
$mostrar = mysqli_fetch_array($result1);

$rama = $mostrar['id_rama'];
$query2 = "SELECT * FROM ramas WHERE id_rama = $rama";
$result2 = mysqli_query($conn, $query2);
$mostrarR = mysqli_fetch_array($result2);


?>
<title>Editar progresión</title>
<?php



require '../templates/header.php';

$query = "SELECT * FROM ramas";
$result = mysqli_query($conn, $query);

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
<a href="/proyectoGrupoScout/views/admin/progresiones.php" class="btn links_nav m-2" id="newUser">Volver</a>
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
            <h2 class="titulo fw-bold text-center py-3">Editar planes de progresión</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/editarProgresion.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                    <label class="form-label fw-bold titulo">Nombres: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" value="<?php echo $mostrar['nombres'] ?>" readonly>
                    </div>
                    <div class="">
                    <label class="form-label fw-bold titulo">Apellido: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellidos" placeholder="Apellidos" data-bs-toggle="tooltip" data-bs-placement="top" title="Apellidos" value="<?php echo $mostrar['apellido1'] ?>" readonly>
                    </div>

                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                    <label class="form-label fw-bold titulo">No. de documento: </label>
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" value="<?php echo $mostrar['documento'] ?>" readonly>
                    </div>
                    <div class="">
                    <label class="form-label fw-bold titulo">Fecha de entrega: </label>
                        <input type="date" class="form-control mb-3 fw-bold input_login" name="fechaEntrega" placeholder="Fecha de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha de entrega" value="<?php echo $mostrar['fechaEntrega'] ?>" required>
                        
                    </div>
                </div>
                
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                    <label class="form-label fw-bold titulo">Rama anterior:</label>
                    <?php echo $mostrarR['nom_rama'] ?></span>
                    </div>

                    
                    <div class="" >
                    <label class="form-label fw-bold titulo">Progresión anterior:</label>
                    <?php echo $mostrar['nombreTipoAdelanto']  ?>
                    <input type="hidden" class="form-control mb-3 fw-bold input_login" name="idAdelantoAnterior" placeholder="Fecha de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha de entrega" value="<?php echo $mostrar['id_t_adelanto'] ?>"  required>

                    </div>

                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="">
                        <!--COMBO BOX RAMA -->
                        <select id="rama_progresion" class="form-select mb-3 fw-bold input_login" name="rama_progresion" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la rama">
                            <option disabled selected value>Seleccionar nueva rama</option>
                            <?php
                            while ($mostrar2 = mysqli_fetch_array($result)) { ?>

                                <option value="<?php echo $mostrar2['id_rama']; ?>"><?php echo $mostrar2['nom_rama']; ?></option>


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
                        <label for="lugarEntrega" class="form-label fw-bold titulo">Lugar de entrega: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="lugarEntrega" placeholder="Lugar de entrega" data-bs-toggle="tooltip" data-bs-placement="top" title="Lugar de entrega" required value="<?php echo $mostrar['lugarEntrega'] ?>" required>
                    </div>
                    <div class="">
                        <label for="dirigente" class="form-label fw-bold titulo">Dirigente a cargo: </label>
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="dirigente" placeholder="Dirigente a cargo" data-bs-toggle="tooltip" data-bs-placement="top" title="Dirigente a cargo" required value="<?php echo $mostrar['dirigente'] ?>" required>
                    </div>
                </div>

                <div class="row ">
                    <div class="">
                    <label for="costo" class="form-label fw-bold titulo">Costo: </label>
                        <input type="Number" class="form-control mb-3 fw-bold input_login" name="costo" placeholder="Costo" data-bs-toggle="tooltip" data-bs-placement="top" title="Costo" value="<?php echo $mostrar['costo'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center p-2">
                        <button type="submit" name="editarP" class="btn btn_general">Editar seguimiento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require '../templates/footer.php';

?>