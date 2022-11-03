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
                <div class="row">
                    <p class="text-wrap text-center titulo fst-italic">¡Si te interesa hacer parte de esta grandiosa familia, regístrate y nosotros nos pondremos en contacto contigo!</p>
                </div>
                
                <!-- formlario registro -->
                <form action="../queries/registrarV.php" method="POST" class="p-3 justify-content-center align-items-center">
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus placeholder="Nombres"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" placeholder="Primer apellido"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Primer apellido" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                        </div>

                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2" placeholder="Segundo apellido"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Segundo apellido" minlength="3" maxlength="20" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" required>
                        </div>
                        <div class="">
                            <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Seleccione el tipo de documento">
                                <option disabled selected value>Tipo de Documento</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">Cédula de Ciudadania</option>
                                <option value="CE">Cédula de Extranjería</option>
                            </select>
                        </div>


                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" placeholder="No. de documento"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Número de documento" required minlength="7" maxlength="10" pattern="[0-9]" required>
                        </div>
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="telefono" placeholder="Celular"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Celular" minlength="7" maxlength="15" pattern="[0-9] required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="">
                            <input type="email" class="form-control mb-3 fw-bold input_login" name="correo" placeholder="Correo"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Correo" maxlength="50" required>
                        </div>
                        <!-- <div class="">
                            <input type="password" class="form-control mb-3 fw-bold input_login" name="contrasena" placeholder="Contraseña"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña" required minlength="8">
                        </div> -->
                    </div>

                    <div class="row d-flex justify-content-center align-content-center">
                        <div class="col d-flex justify-content-center align-items-center p-2">
                            <input class="form-check-input m-1" type="checkbox" value="" id="checkRegistro" required>
                            <label class="form-check-label m-1" for="checkRegistro">
                                Acepto Términos y Condiciones
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