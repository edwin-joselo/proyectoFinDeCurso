<?php
    require_once '../bd/conexion.php';
    require_once '../bd/consultas.php';
    require_once '../php/funciones.php';

    session_start();

    $conexion = abrir_conexion_PDO();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/global/global.css">
    <link rel="stylesheet" href="../css/global/monitor.css">
    <link rel="stylesheet" href="./css/menu/monitor.css">
    <link rel="stylesheet" href="./css/denuncias/monitor.css">
    <link rel="stylesheet" href="../css/sweetalert2/dark.css">
    <script src="../javascript/sweetalert2.js"></script>
</head>
<body>
    <?php
    include_once './maquetacion/menu/cabecera.php';
    include_once './maquetacion/imprimir_denuncias/principal.php';

    if(isset($_POST['mostrar_foto'])){
        mostrar_foto($conexion, $_POST['cod']);
    }
    ?>
    <script type="text/javascript" src="../javascript/maintainscroll.min.js"></script>
    <script src="../javascript/cabecera_admin.js"></script>
    <script src="../javascript/login.js"></script>
</body>
</html>