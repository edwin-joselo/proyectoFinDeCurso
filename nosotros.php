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
    <title>Sobre nosotros</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    <link rel="stylesheet" href="./css/global/movil.css">

    <!-- MAQUETACIÓN -->
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/nosotros/monitor.css">

    <link rel="stylesheet" href="./css/login/movil.css">
    <link rel="stylesheet" href="./css/nosotros/movil.css">
</head>
<body>

    <?php 
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/nosotros/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

    <!-- JAVASCRIPT -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfulz2jpJ3DGJQRHy-cpOjARGoGIUSLY8&callback=initMap">
    </script>
    <script src="./javascript/codigo.js"></script>
    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
</body>
</html>