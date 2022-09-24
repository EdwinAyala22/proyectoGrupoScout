<title>Gráficas</title>
<?php

require '../templates/header.php';
include_once '../../queries/conexion.php';





// echo $Total

$sql_act = "SELECT * FROM f_actividades";
$result_sql_act = mysqli_query($conn, $sql_act);
$name_act = '';

if (isset($_POST['generar'])) {
    $_act_id = $_POST['id_act'];
    $cons_act = "SELECT * FROM f_actividades WHERE id_act = $_act_id";
    $res_act = mysqli_query($conn, $cons_act);
    $array_rama = mysqli_fetch_array($res_act);
    $idRama= $array_rama['id_rama'];
    $name_act = $array_rama['nombre_act'];
    // Scouts inscritos
    $sql1 = "SELECT COUNT(*) LosInscritos FROM inscritos I, f_actividades F WHERE I.id_act = $_act_id AND F.id_rama = $idRama";
    $result = mysqli_query($conn, $sql1);
    $Inscritos = mysqli_fetch_array($result);
    $NInscritos = $Inscritos['LosInscritos'];

    //Scouts no inscritos
    $sqlNo ="SELECT COUNT(*) NoAsistieron FROM usuarios WHERE id_rama = $idRama";
    $resultNO = mysqli_query($conn, $sqlNo);
    $NO_Inscritos = mysqli_fetch_array($resultNO);
    $NOInscritos = $NO_Inscritos['NoAsistieron'];

    $Total = $NOInscritos - $NInscritos;



}

?>

<a href="/proyectoGrupoScout/views/admin/menuAdmin.php" class="btn links_nav m-2">Volver</a>

<div class="container-fluid mt-4 mb-4 d-flex flex-wrap justify-content-center">
    <!-- <div style="width: 400px;" class="mx-3">
        <canvas id="myChart" class="m-3"></canvas>
    </div> -->
    <div style="width: 450px;" class="shadow bg-light p-5 rounded">
        
        <form action="/proyectoGrupoScout/views/graficas/graficas.php" method="POST">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5 d-flex justify-content-center align-items-center mb-3">
                    <select class="form-select fw-bold input_login" name="id_act" required data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione la actividad">
                    <option disabled selected value>Seleccionar actividad</option>
                        <?php
                            while ($mostrar = mysqli_fetch_array($result_sql_act)) { ?>

                                <option value="<?php echo $mostrar['id_act']; ?>"><?php echo $mostrar['nombre_act'];?></option>
                            
                                
                            <?php    
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-center mb-3">
                    <button type="submit" name="generar" class="btn btnEditar">Generar</button>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-center mb-3">
                    <a href="/proyectoGrupoScout/views/graficas/graficas.php" class="btn btnEliminar">Limpiar</a>
                </div>
            </div>
        </form>
        <h4 class="titulo text-center"><?php echo $name_act ?></h4>
        <canvas id="myChartDos"></canvas>
    </div>
</div>


<script>
    const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
    const data = {
        labels: labels,
        datasets: [{
            label: ['Eso'],
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    )
</script>
<script>
    const data2 = {
        labels: [
            'Asistieron',
            'No asistieron'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [<?php echo $NInscritos ?>, <?php echo $Total ?>],
            backgroundColor: [
                'rgb(30, 9, 65)',
                'rgb(237, 27, 37)'
            ],
            hoverOffset: 4
        }]
    };

    const config2 = {
        type: 'doughnut',
        data: data2,
    };

    var myChartDos = new Chart(
        document.getElementById('myChartDos'),
        config2
    )
</script>
<?php

require '../templates/footer.php';

?>