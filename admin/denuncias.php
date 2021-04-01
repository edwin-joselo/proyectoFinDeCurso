<?php
    session_start();
    
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';


    $conexion = abrir_conexion_PDO();
    
    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['policia']);
    }
    
    if(!isset($_SESSION['policia'])){
        include_once './../php/redireccionar_index.php';
    }

    if(isset($_POST['aceptar_denuncia'])){
        aceptar_denuncia($conexion, $_POST['cod'], $_POST['dni'], $_POST['delito'],$_SESSION['policia'], $_POST['descripcion_policia']);
    }

    if(isset($_POST['rechazar_denuncia'])){
        rechazar_denuncia($conexion, $_POST['cod']);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="../css/global/global.css">
    <link rel="stylesheet" href="../css/global/monitor.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/menu/monitor.css">
    <link rel="stylesheet" href="./css/denuncias/monitor.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>
</head>
<body>
    <?php
    include_once './maquetacion/menu/cabecera.php';
    include_once './maquetacion/denuncias/principal.php';

    if(isset($_POST['mostrar_foto'])){
        mostrar_foto($conexion, $_POST['cod']);
    }
    ?>

    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="../javascript/maintainscroll.min.js"></script>
    <script src="../javascript/cabecera_admin.js"></script>
    <script src="../javascript/login.js"></script>
</body>
</html>