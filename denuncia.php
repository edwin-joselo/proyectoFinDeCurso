<?php 
    session_start();

    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/global.css">
    <!-- <link rel="stylesheet" href="./css/registro/monitor.css"> -->
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/denuncia/monitor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/denuncia/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

    <script src="./javascript/login.js"></script>
</body>
</html>