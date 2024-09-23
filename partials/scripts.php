<script src="../public/vendor/libs/jquery/jquery.js"></script>
<script src="../public/vendor/libs/popper/popper.js"></script>
<script src="../public/vendor/js/bootstrap.js"></script>
<script src="../public/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../public/vendor/js/menu.js"></script>
<script src="../public/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../public/js/main.js"></script>
<script src="../public/js/dashboards-analytics.js"></script>
<script src="../public/vendor/libs/sweetalert2/sweetalert2.all.min.js"></script>
<?php include('alert.php'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
    /* Init Data Tables */
    $(document).ready(function() {
        $('.table').DataTable();
        $('.table td').css('white-space', 'initial');

    });

    $(document).ready(function() {
        $('.report_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    /* Prevent double resubmission on browser refresh */
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>