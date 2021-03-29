<?php 
    session_start();

    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['dni']);
    }

    $errores = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./admin/css/denuncias/monitor.css">
    <link rel="stylesheet" href="./css/denuncia/monitor.css">
</head>
<body>

    <?php 
        include_once './maquetacion/index/cabecera.php'; 
        include_once './maquetacion/estadisticas/principal.php';
        include_once './maquetacion/index/pie.php';
    ?>

    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="./javascript/graficas.js"></script>
</body>
</html>