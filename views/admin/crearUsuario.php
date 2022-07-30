<title>Crear nuevo usuario</title>
<?php

require '../templates/header.php';

?>
<a href="/proyectoGrupoScout/views/admin/listUsers.php" class="btn links_nav m-2">Volver</a>

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
                <h2 class="titulo fw-bold text-center py-3">Crear nuevo usuario</h2>
                <!-- formlario registro -->
                <form action="./validaciones/vCrearEvento.php" method="POST" class="p-3 form_registro justify-content-center align-items-center">
                    <div class="row row-cols-md-3 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="nombres" autofocus
                                placeholder="Nombres" title="Nombres" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido1" autofocus
                                placeholder="Primer apellido" title="Primer apellido" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="apellido2"
                                placeholder="Segundo apellido" title="Objetivo" required>
                        </div>
                    </div>
                    <div class="row row-cols-md-3 row-cols-sm-1">
                    <div class="">
                            <select class="form-select mb-3 fw-bold input_login" name="tipodoc" required data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Seleccione el tipo de documento">
                                <option disabled selected value>Tipo de Documento</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">Cédula de Ciudadania</option>
                                <option value="CE">Cédula de Extranjería</option>
                            </select>
                        </div>
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="documento" 
                            placeholder="No. de documento" title="Número de documento" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="area"
                                placeholder="Área" title="Área" required>
                        </div>
                        

                    </div>
                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaInicio"
                                placeholder="Fecha Inicio" data-bs-toggle="tooltip" title="Fecha y hora de inicio" required>
                        </div>
                        <div class="">
                            <input type="datetime-local" class="form-control mb-3 fw-bold input_login" name="fechaFin"
                                placeholder="Fecha Final" data-bs-toggle="tooltip" title="Fecha y hora final" required>
                        </div>
                    </div>

                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="lugar"
                                placeholder="Lugar" title="Lugar" required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="nombre_act"
                                placeholder="Nombre de la actividad" title="Nombrea actividad" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="">
                            <textarea class="form-control mb-3 fw-bold input_login" name="descri_act"
                                placeholder="Descripción actividad..." title="Descripción actividad..." required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <textarea class="form-control mb-3 fw-bold input_login" name="materiales"
                                placeholder="Materiales..." title="Materiales..." required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <textarea class="form-control mb-3 fw-bold input_login" name="fact_riesgo"
                                placeholder="Factores de riesgo" title="Factores de riesgo" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <textarea class="form-control mb-3 fw-bold input_login" name="evaluacion_act"
                                placeholder="Evaluación actividad" title="Evaluación actividad" required></textarea>
                        </div>
                    </div>

                    <div class="row row-cols-md-2 row-cols-sm-1">
                        <div class="">
                            <input type="text" class="form-control mb-3 fw-bold input_login" name="f_elab_por"
                                placeholder="Actividad elaborada por" title="Actividad elaborada por" required>
                        </div>
                        <div class="">
                            <input type="number" class="form-control mb-3 fw-bold input_login" name="costo"
                                placeholder="Costo actividad" title="Costo actividad" required>
                        </div>
                        <div class="">
                            <select class="form-select mb-3 fw-bold input_login" name="rama" required title="Seleccione la rama">
                                <option disabled selected value>Seleccione la rama</option>
                                <option value="Lobatos">Lobatos</option>
                                <option value="Scuts">Scouts</option>
                                <option value="Caminantes">Caminantes</option>
                                <option value="Rovers">Rovers</option>
                                <option value="Dirigentes">Dirigentes</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center p-2">
                            <button type="submit" class="btn btn_general">Crear actividad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php

require '../templates/footer.php';

?>