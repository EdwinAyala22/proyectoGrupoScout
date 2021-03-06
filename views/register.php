<?php
require '../views/templates/header.php';
?>
<title>Registro</title>

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
                <h2 class="titulo fw-bold text-center py-3">Registro</h2>
                <!-- formlario registro -->
                <form action="../queries/registrarV.php" method="POST" class="p-3 justify-content-center align-items-center">
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Primer apellido" required>
                        </div>

                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Segundo apellido" required>
                        </div>
                        <div class="">
                            <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Seleccione el tipo de documento">
                                <option disabled selected value>Tipo de Documento</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">C??dula de Ciudadania</option>
                                <option value="CE">C??dula de Extranjer??a</option>
                            </select>
                        </div>


                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="N??mero de documento" required>
                        </div>
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="Celular"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Celular" required>
                        </div>
                    </div>

                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" required>
                        </div>
                        <div class="">
                            <input type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contrase??a"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Contrase??a" required>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center align-content-center">
                        <div class="col d-flex justify-content-center align-items-center p-2">
                            <input class="form-check-input m-1" type="checkbox" value="" id="checkRegistro" required>
                            <label class="form-check-label m-1" for="checkRegistro">
                                Acepto T??rminos y Condiciones
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center p-2">
                            <button type="submit" class="btn btn_general">Registrarme</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

<?php
require '../views/templates/footer.php';
?>