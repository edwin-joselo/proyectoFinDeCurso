<?php 
    session_start();

    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';

    $conexion = abrir_conexion_PDO();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['policia']);
    }

    if(!isset($_SESSION['policia'])){
        include_once './../php/redireccionar_index.php';
    }

    $errores = [];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delitos</title>

    <!-- GLOBAL -->
    <link rel="stylesheet" href="../css/global/global.css">
    <link rel="stylesheet" href="../css/global/monitor.css">
    <link rel="stylesheet" href="../css/global/tablet.css">
    <link rel="stylesheet" href="../css/global/movil.css">

    <!-- MAQUETACIÓN USUARIO-->
    <link rel="stylesheet" href="../css/login/monitor.css">
    <link rel="stylesheet" href="../css/denuncia/monitor.css">

    <link rel="stylesheet" href="../css/login/tablet.css">
    <link rel="stylesheet" href="../css/denuncia/tablet.css">

    <link rel="stylesheet" href="../css/login/movil.css">
    <link rel="stylesheet" href="../css/denuncia/movil.css">

    <!-- SWEETALERT2 -->
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>
</head>
<body>
    <?php
    if (isset($_POST['aniadir_delito'])){

        $errores = comprobar_error_delito($_POST['nombre'], $errores);

        if(!$errores){
            if(insertar_delito($conexion)){
                echo '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Éxito",
                        text: "El delito se ha insertado correctamente",
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>';
            }
        } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "'.$errores['nombre'].'",
                        "error"
                    );
                </script>';
        }
    }

    if(isset($_POST['eliminar'])){
        $eliminado = eliminar_delito($conexion);
        if(!$eliminado){
            ?>
             <script>
                    Swal.fire({
                      title: 'El delito no se pudo eliminar',
                      text: "Para poder eliminar el delito debes borrar todas las denuncias que tienen asociado este delito",
                      icon: 'error',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Borrar denuncias',
                      cancelButtonText: 'Cancelar'
                    }).then((result) => {
                      if (result.isConfirmed) {
                          Swal.fire({
                            title: '¿Estás seguro?',
                            text: "No podrás deshacer este cambio",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "¡Eliminado!",
                                    text: "Las denuncias han sido eliminadas correctamente",
                                    timer: 3000,
                                    showConfirmButton: false
                                });

                                setTimeout(() => {
                                    window.location.href="../bd/eliminar_denuncias.php";
                                }, 3000);
                            }
                        })
                      }
                    })

                </script>
            <?php
        }
    }
    
    include_once './maquetacion/menu/cabecera.php';
    include_once './maquetacion/delitos/principal.php';
    ?>

    <!-- MAQUETACIÓN -->
    <script src="../javascript/login.js"></script>
    <script src="../javascript/cabecera_admin.js"></script>

</body>
</html>