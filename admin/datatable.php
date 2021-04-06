<?php
    session_start();
    
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';


    // if(!isset($_SESSION['policia'])){
    //     include_once './../php/redireccionar_index.php';
    // }
    
    // if(isset($_POST['cerrar_sesion'])){
    //     unset($_SESSION['policia']);
    // }
    
    $conexion = abrir_conexion_PDO();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Denuncias</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="../css/global/global.css">
    <link rel="stylesheet" href="../css/global/monitor.css">
    
     <!-- MAQUETACIÓN USUARIO -->
    <link rel="stylesheet" href="../css/login/monitor.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/listar_denuncias/monitor.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">

    <!-- Datatables -->
    <!-- <link rel="stylesheet" href="../css/datatables/jquery.dataTables.css"> -->

</head>
<body>
    <?php
    include_once './maquetacion/datatable/principal.php';
    ?>

    <script src="../javascript/datatables/jquery.js"></script>
    <script src="../javascript/datatables/jquery.dataTables.js"></script>
    
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );
        } );
    </script>


        <!-- JQUERY -->
    <!-- <script src="../javascript/datatables/tabla-traduccion.js"></script> -->

    <!-- JAVASCRIPT -->
    <!-- <script src="../javascript/login.js"></script>
    <script src="../javascript/cabecera_admin.js"></script> -->
</body>
</html>