<?php
    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    $errores = [];

    if(isset($_POST['iniciar_sesion'])){
        $errores = comprobar_errores_login($_POST['email'], $_POST['contrasenia'], $errores);

        if(!$errores){
            if(comprobar_usuario_bd($conexion)){
                echo 'Bienvenido';
            } else {
                echo 'no se pudo';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/login/monitor.css">
</head>
<body>

    <?php 
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/login/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

    <script src="./javascript/login.js"></script>
</body>
</html>