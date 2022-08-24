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


if(isset($_GET['edit'])){
    $documento = $_GET['edit'];
    $query = "SELECT * FROM usuarios U, ramas R, roles L WHERE U.id_rama = R.id_rama AND U.id_rol= L.id_rol AND U.documento = $documento";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
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
        $idRol= $mostrar['id_rol'];
        $idRama= $mostrar['id_rama'];

    }
    else{
        echo "Error";
    }
}

// if(isset($_POST['editar'])){
//     $id = $_GET['id'];
//     $nombres = $_POST['nombres'];
//     $apellidos = $_POST['apellidos'];
//     $correo = $_POST['correo'];
//     $usuario = $_POST['usuario'];
//     $contrasena = $_POST['contrasena'];

//     $query = "UPDATE usuarios set nombres = '$nombres', apellidos = '$apellidos', correo = '$correo', usuario = '$usuario', contrasena = '$contrasena' WHERE id = $id";
//     if (mysqli_query($conn,$query)){
//         header("Location: ./usuarios.php");
//     }
// }


?>

<title>Editar usuario</title>

<?php

require '../templates/header.php';

?>

<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2"  id="newUser">Volver</a>

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
            <h2 class="titulo fw-bold text-center py-3">Editar usuario</h2>
            <!-- formlario registro -->
            <form action="/proyectoGrupoScout/views/admin/listUsers.php?edit=<?php echo $doc?>" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres" title="Nombres" required value="<?php echo $name ?>">
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido" title="Primer apellido" required value="<?php echo $ape1 ?>">
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido" title="Segundo apellido" required value="<?php echo $ape2 ?>">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione el tipo de documento">
                            <option disabled value>Tipo de Documento</option>
                            <?php
                            switch($tipoD){
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
                                <option  value="CC">Cédula de Ciudadania</option>
                                <option selected value="CE">Cédula de Extranjería</option>
                            <?php
                                break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento" title="Número de documento" required value="<?php echo $doc ?>">
                    </div>
                    <div class="">
                        <input type="date" class="form-control mb-3 fw-bold input_login" name="fecha_nacimiento" placeholder="Fecha de nacimiento" title="Fecha de nacimiento" required value="<?php echo $f_nac ?>">
                    </div>
                </div>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="No. de celular" title="No. de celular" required value="<?php echo $tel ?>">
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="direccion" placeholder="Dirección" title="Dirección" required value="<?php echo $dire ?>">
                    </div>
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="eps" placeholder="Nombre EPS" title="Nombre EPS" required value="<?php echo $ePS ?>">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="rh" title="Seleccione el tipo de sangre" required>
                            <option disabled selected value>RH</option>
                            <?php
                            switch($rH){
                                case 'A+':
                            ?>	
                                <option selected value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'A-':
                            ?>
                                <option value="A+">A+</option>
                                <option selected value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'B+':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option selected value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'B-':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option selected value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'AB+':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option selected value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'AB-':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option selected value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'O+':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option selected value="O+">O+</option>
                                <option value="O-">O-</option>
                            <?php
                                break;
                                case 'O-':
                            ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option selected value="O-">O-</option>
                            <?php
                                break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="">
                        <select class="form-select mb-3 fw-bold input_login" name="genero" title="Género" required>
                            <option disabled selected value>Género</option>
                            <?php
                            switch($gender){
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
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="grupo_anterior" placeholder="¿Grupo anterior?" title="¿Grupo anterior?" required value="<?php echo $back_group ?>">
                    </div>
                </div>

                <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                        <input type="text" class="form-control mb-3 fw-bold input_login" name="ciudad" placeholder="Ciudad/municipio" title="Ciudad/municipio" required value="<?php echo $ciu ?>">
                    </div>
                    <div class="">
                        <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo" title="Correo" required value="<?php echo $email ?>">
                    </div>
                    <div class="">
                        <input type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña" title="Contraseña" required value="<?php echo $pass ?>">
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
                            <?php
                            switch($idRol){
                                case 1:
                            ?>	
                                <option selected value="1">Admin</option>
                                <option value="2">Scout</option>
                                <option value="3">Visitante</option>
                            <?php
                                break;
                                case 2:
                            ?>
                                <option value="1">Admin</option>
                                <option selected value="2">Scout</option>
                                <option value="3">Visitante</option>
                            <?php
                                break;
                                case 3:
                            ?>
                                <option value="1">Admin</option>
                                <option value="2">Scout</option>
                                <option selected value="3">Visitante</option>
                            <?php
                                break;
                            }
                            ?>
                            <!-- <option value="1">Admin</option>
                            <option value="2">Scout</option>
                            <option value="3">Visitante</option> -->
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

require '../templates/footer.php';

?>