<?php
    session_start();
    
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';


    
    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['policia']);
    }
    
    if(!isset($_SESSION['policia'])){
        include_once './../php/redireccionar_index.php';
    }
    
    $conexion = abrir_conexion_PDO();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="../css/global/global.css">
    <link rel="stylesheet" href="../css/global/monitor.css">
    <link rel="stylesheet" href="../css/global/movil.css">
    <link rel="stylesheet" href="../css/global/tablet.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/menu/monitor.css">
    <link rel="stylesheet" href="./css/menu/tablet.css">
    <link rel="stylesheet" href="./css/menu/movil.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>
</head>
<body>

    <?php
    include_once './maquetacion/menu/cabecera.php';
    include_once './maquetacion/menu/principal.php';
    ?>
    
</body>
</html>