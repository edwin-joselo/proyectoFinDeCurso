<?php
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';

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
    <link rel="stylesheet" href="../css/login/monitor.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>
</head>
<body>
    <?php
        if(isset($_POST['iniciar_sesion'])){
            $errores = comprobar_errores_login_policia($_POST['num_placa'], $_POST['contrasenia'], $errores);
            if(!$errores){
                if(comprobar_policia_bd($conexion)){
                    echo '
                        <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Logueado correctamente",
                            text: "Redirigiendo al menú...",
                            timer: 3000,
                            showConfirmButton: false
                        });
    
                        setTimeout(() => {
                            window.location.href="./menu.php";
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

        include_once './maquetacion/login/principal.php';
    ?>
</body>
</html>