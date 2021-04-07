<?php 
    session_start();

    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['dni']);
    }

    if(!isset($_SESSION['dni'])){
        include_once './php/redireccionar_index.php';
    }

    $errores = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis denuncias</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    <link rel="stylesheet" href="./css/global/movil.css">
    <link rel="stylesheet" href="./css/global/tablet.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/login/tablet.css">
    <link rel="stylesheet" href="./css/denuncia/monitor.css">
    <link rel="stylesheet" href="./css/mis_denuncias/movil.css">

    <!-- MAQUETACIÓN ADMIN -->
    <link rel="stylesheet" href="./admin/css/denuncias/monitor.css">
    <link rel="stylesheet" href="./admin/css/denuncias/tablet.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
</head>
<body>
    <?php 
        include_once './maquetacion/index/cabecera.php'; 
        include_once './maquetacion/mis_denuncias/principal.php';
        include_once './maquetacion/index/pie.php';
    ?>

    <!-- JAVASCRIPT -->
    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
</body>
</html>