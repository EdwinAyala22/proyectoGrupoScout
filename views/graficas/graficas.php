<?php

require '../templates/header.php';
include_once '../../queries/conexion.php';

?>

<div class="container mt-4 mb-4 d-flex flex-wrap">
    <div style="width: 500px;" class="mx-3">
        <canvas id="myChart"></canvas>
    </div>
    <div style="width: 400px;">
        <h4 class="titulo text-center">Asistencia</h4>
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
            data: [300, 50],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)'
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