<?php
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';

    session_start();

    if(!isset($_SESSION['policia'])){
        header("Location: index.php");
    }
    
    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['policia']);
    }
    
    $conexion = abrir_conexion_PDO();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="../css/global/global.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="../css/login/monitor.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>

    <!-- Datatables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="../datatables/css/jquery.dataTables.css">

</head>
<body>
    <?php
    include_once './maquetacion/listar_usuarios/cabecera.php';
    include_once './maquetacion/listar_usuarios/principal.php';
    ?>

    <!-- JQUERY -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="../datatables/js/jquery.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <script src="../datatables/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        } );
    </script>
</body>
</html>