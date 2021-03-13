<?php 
    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    $errores = [];
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
    <script src="./javascript/sweetalert2.js"></script>
    <link rel="stylesheet" href="./css/sweetalert2/sweetalert2.css">
</head>
<body>
    <?php
    if(isset($_POST['registrarse'])){
        $errores = comprobar_errores_registro($_POST['dni'], $_POST['nombre'], $_POST['apellidos'], $_POST['fecha_nacimiento'], $_POST['telefono'], $_POST['email'], $_POST['contrasenia'], $_POST['repetir_contrasenia'], $errores);
        
        if(!$errores){
            insertar_usuario($conexion);
        }
        else {
            foreach($errores as $value => $key){
                echo '<script>
                Swal.fire(
                    "ERROR!",
                    "'.$key.'",
                    "error"
                );
                </script>';
            }
        }
        
    }
    
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/registro/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>
    
    <script src="./javascript/login.js"></script>
    <script src="./javascript/general.js"></script>
</body>
</html>