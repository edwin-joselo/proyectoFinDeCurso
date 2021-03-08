<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./javascript/sweetalert2.js"></script>
    <link rel="stylesheet" href="./css/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/index/movil.css">
    <link rel="stylesheet" href="./css/index/tablet.css">
    <link rel="stylesheet" href="./css/index/monitor.css">
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
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
