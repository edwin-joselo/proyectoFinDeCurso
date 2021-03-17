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
    <link rel="stylesheet" href="./css/global/global.css">
    <!-- <link rel="stylesheet" href="./css/global/monitor.css"> -->
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
    <script src="./javascript/sweetalert2.js"></script>
</head>
<body>

    <?php 
    if(isset($_POST['iniciar_sesion'])){
        $errores = comprobar_errores_login($_POST['email'], $_POST['contrasenia'], $errores);

        if(!$errores){
            if(comprobar_usuario_bd($conexion)){
                echo '
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Logueado correctamente",
                        text: "Redirigiendo a la página principal...",
                        timer: 3000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href="./index.php";
                    }, 3000);
                    </script>';
            
            } else {
                echo '
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error al iniciar sesion",
                        text: "Ha habido un problema, intentelo más tarde...",
                        timer: 3000,
                        showConfirmButton: false
                    });
                    </script>';
            }
        } else {
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
    include_once './maquetacion/login/cabecera.php';
    include_once './maquetacion/login/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
</body>
</html>