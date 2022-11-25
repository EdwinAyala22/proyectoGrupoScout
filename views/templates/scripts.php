<script src="/proyectoGrupoScout/assets/lib/SweetAlert2/dist/sweetalert2.all.min.js"></script>
<script src="/proyectoGrupoScout/assets/lib/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js"></script>
<script src="/proyectoGrupoScout/assets/lib/DataTables/DataTables-1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="/proyectoGrupoScout/assets/lib/DataTables/Responsive-2.4.0/js/dataTables.responsive.min.js"></script>
<script src="/proyectoGrupoScout/assets/lib/DataTables/Responsive-2.4.0/js/responsive.bootstrap5.min.js"></script>

<script lang="javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            responsive: true,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, 'All'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
        });
    });
</script>