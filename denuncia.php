<?php 
    session_start();

    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['dni']);
    }

    if(!isset($_SESSION['dni'])){
        header("Location: index.php");
    }

    $errores = [];
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
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/denuncia/monitor.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
    <script src="./javascript/sweetalert2.js"></script>

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
    if (isset($_POST['enviar_denuncia'])){
        
        $errores = comprobar_errores_denuncia($_POST['fecha_delito'], $_POST['textarea'], $_FILES['inputfile']['tmp_name'], $errores);
        
        if(!$errores){
            insertar_denuncia($conexion);
            echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "¡Hecho!",
                    text: "Denuncia enviada y a la espera de que sea revisada",
                    timer: 3000,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                setTimeout(() => {
                    window.location.href="./index.php";
                }, 3000);
                </script>';
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
    
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/denuncia/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

    <!-- JAVASCRIPT -->
    <script src="./javascript/inputFile.js"></script>
    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>

</body>
</html>