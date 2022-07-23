<title>Recuperar Contraseña</title>
<?php
require '../views/templates/header.php';
?>

<div class="container w-75 mt-5 mb-5 container_general">
        <div class="row align-items-stretch">
            <div class="col m-auto d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
                <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="350" class="d-flex m-auto">
            </div>
            <div class="col p-5">
                <div class="row text-center d-block d-sm-block d-md-block d-lg-none">
                    <div class="">
                        <img src="/proyectoGrupoScout/assets/img/LOGO_GS.png" alt="" width="180" class="img-fluid">
                    </div>
                </div>
                <h2 class="titulo fw-bold text-center py-5">Recuperar contraseña</h2>
                <!-- formlario login -->

                <form action="">
                    
                    <div class="mb-4 iconos_login">
                        <i class="login__icon fas fa-user"></i>
                        <input type="number" class="form-control text-center fw-bold input_login" name="documento" placeholder="Usuario"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required autofocus>
                    </div>
                    <div class="mb-4 iconos_login">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="form-control text-center fw-bold input_login" name="contrasena" placeholder="Contraseña"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña" required>
                    </div>
                    <div class="mb-4 iconos_login">
                        <i class="login__icon fas fa-envelope"></i>
                        <input type="email" class="form-control text-center fw-bold input_login" name="correo" placeholder="Correo"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required>
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn_general">Recuperar</button>
                    </div>
                    <div class="mb-4 text-center">
                        <p class="titulo fst-italic"> Volver a <a href="/proyectoGrupoScout/views/login.php" class="titulo fw-bold link_login">Inicio de sesión</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php
require '../views/templates/footer.php';
?>