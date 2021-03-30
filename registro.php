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
    <link rel="stylesheet" href="css/global/global.css">
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
    <script src="./javascript/sweetalert2.js"></script>
    <link rel="stylesheet" href="./css/sweetalert2/dark.css">
</head>
<body>
    <?php
    if(isset($_POST['registrarse'])){
        $errores = comprobar_errores_registro($_POST['dni'], $_POST['nombre'], $_POST['apellidos'], $_POST['fecha_nacimiento'], $_POST['telefono'], $_POST['email'], $_POST['contrasenia'], $_POST['repetir_contrasenia'], $errores);
        
        if(!$errores){
            if(insertar_usuario($conexion)){
                echo '
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Registrado correctamente",
                        text: "Redirigiendo al login ...",
                        timer: 3000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    setTimeout(() => {
                        window.location.href="./login.php";
                    }, 3000);
                    </script>';
            } else {
                echo '
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Algo ha fallado",
                        text: "Intentelo de nuevo más tarde...",
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
    include_once './maquetacion/registro/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>
    
    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
    <script src="./javascript/comunidades_autonomas.js"></script>
</body>
</html>