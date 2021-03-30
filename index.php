<?php 
    session_start();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['dni']);
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
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    
    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/index/movil.css">
    <link rel="stylesheet" href="./css/index/tablet.css">
    <link rel="stylesheet" href="./css/index/monitor.css">
    
    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="./css/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
    <script src="./javascript/sweetalert2.js"></script>
</head>
<body>

    <?php
    echo '<div class="cabecera">';
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/index/menu.php';
    echo '</div>';
    include_once './maquetacion/index/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>
</body>
</html>
