<?php
$productos = array(
    "assets/img/accesorios.jpeg",
    "assets/img/gorras.jpeg",
    "assets/img/camping.jpeg",
    "assets/img/insignias.jpeg",
    "assets/img/gorras.jpeg",
    "assets/img/accesorios.jpeg",
    "assets/img/gorras.jpeg",
    "assets/img/camping.jpeg",
    "assets/img/insignias.jpeg",
    "assets/img/gorras.jpeg",
    "assets/img/accesorios.jpeg",
    "assets/img/camping.jpeg",
);
$nombreP = array(
    "Accesorios",
    "Gorras",
    "Camping",
    "Insignias",
    "Gorras",
    "Accesorios",
    "Gorras",
    "Camping",
    "Insignias",
    "Gorras",
    "Accesorios",
    "Camping",
);
$n = count($productos) - 1;



?>
<div class="container-xxl">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/slider-uno.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/img/slider-dos.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/img/slider-tres.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/img/slider-cuatro.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- cards -->
<div class="container container_productos d-flex flex-wrap justify-content-center align-items-center mt-3 mb-3">

    <?php
    for ($i = 0; $i <= 2; $i++) {
    ?>
        <div class="card card_productos text-center m-4" style="width: 18rem;">
            <img src="<?php echo $productos[$i] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title fw-bolder" style="color: #1e0941;"><?php echo $nombreP[$i] ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <button type="submit" class="btn btn_general"> <strong>Más info...</strong></button>
            </div>
        </div>
    <?php } ?>

</div>

<!-- ¿quiénes somos? -->

<section id="qs" class="mt5 mb-5">
    <div class="container d-flex p-2 flex-wrap">
        <!-- <div class="row d-flex m-auto">
            <div class="">
                <h1 class="text-center fw-bold p-3 titulo" id="QS">¿QUIÉNES SOMOS?</h1>
            </div>
        </div> -->
        <div class="row row-cols-lg-2 row-cols-sm-1">
            <div class="col-lg-7">
                <h1 class="text-center fw-bold p-3 titulo" id="QS">¿QUIÉNES SOMOS?</h1>
                <p class="p-2">Un grupo de adultos deseando proporcionar a la ciudad un grupo Scout nuevo, dinámico y como otra alternativa a los grupos ya existentes,
                    decidieron en una tarde formar el grupo Scout León Blanco, cuyo nombre se escogió gracias a una condecoración que recibiría el fundador
                    del escultismo Lord Baden Powell al visitar el país de Checoslovaquia (Hoy república Checa) en 1923 y que para él fue de un inmenso valor
                    emocional y de un gran aprecio. Así nacía el grupo Scout León Blanco, siendo la Dirigente Ángela María Cortez la primer jefe de grupo, la
                    primer Akela (Dirigente de manada) María Claudia Cortez, el primer jefe de tropa Nelson Bravo y Javier Darío Lemos, el primer dirigente de
                    Clan. Se toma inicialmente como base el colegio Santa Teresita y después de hacer invitación a niños y jóvenes se inicia actividades formales
                    el 25 de febrero de 1995, contando como el primer joven del grupo a Rodrigo Bejarano. El grupo desde su inicio conto con las tres secciones así:
                    los primeros lobatos Carlos Humberto Varela Jr, Brian Mercado y Diana Carolina Molina. La pañoleta de grupo fue idea de los dirigentes Javier
                    Darío Lemos y Nelson Bravo, quienes después de probar varios colores, vieron que los que más acogida tuvieron fueron Gris, Rojo y Azul a los cuales
                    los muchachos dieron los siguientes significados respectivamente Valor, perseverancia y lealtad. El 23 de abril 1995 se dio reconocimiento oficial
                    al grupo, dejando de ser grupo experimental, debido a que al grupo de dirigentes tenían experiencia en el movimiento y el esquema de formación
                    realizado con lo cual el periodo de prueba era suficiente. Con una fogata, se celebró el evento, entregando por parte del jefe regional la primera
                    pañoleta a Angela Maria Cortez como jefe de grupo, después le siguieron el resto de la jefatura y algunos jóvenes renovaron promesa como fue el caso
                    de Lamia Mercado, Miguel y Oscar Echeverri y Julio Ernesto Mejía.</p>
            </div>
            <div class="col-lg-5 d-flex m-auto">
                <img src="/proyectoGrupoScout/assets/img/imagen.jpeg" alt="" class="m-auto img-fluid p-2" width="">
            </div>
        </div>
        <div class="row row-cols-lg-2 row-cols-sm-1">
            <div>
                <h2 class="text-center fw-bold titulo mt-2">MISION</h2>
                <p class="p-2 text-center">Contribuir a la educación de los jóvenes, mediante un sistema de valores basado en la Promesa y la Ley Scout, 
                    para ayudar a construir un mundo mejor donde las personas se sientan realizadas como individuos y jueguen un papel constructivo 
                    en la sociedad.</p>
            </div>
            <div>
                <h2 class="text-center fw-bold titulo mt-2">VISION</h2>
                <p class="p-2 text-center">Para el 2025, la Asociación Scouts de Colombia será uno de los movimientos juveniles líderes en nuestro país, 
                    permitiendo a 50.000 jóvenes convertirse en ciudadanos activos y gestores de paz, creando un cambio positivo en sus comunidades 
                    basado en los valores compartidos.</p>
            </div>
        </div>
    </div>
</section>



<div id="button-up">
    <i class="fas fa-chevron-up"></i>
</div>