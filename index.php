<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./javascript/sweetalert2.js"></script>
    <link rel="stylesheet" href="./css/sweetalert2.css">
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <button id="btnRegistro">Registro</button>

    <?php
    require_once 'bd/conexion.php';
    require_once 'php/consultasBD.php';
    $sentencia = new consultas();
    $mostrardatos=$sentencia->selectPersonas();
    foreach($mostrardatos as $res){
        echo '<p>'.$res['dni'].'</p>';
        echo '<p>'.$res['nombre'].'</p>';
        echo '<p>'.$res['apellidos'].'</p>';
        echo '<p>'.$res['fecha_nacimiento'].'</p>';
        echo '<p>'.$res['telefono'].'</p>';
    }
    ?>

    <script src="./javascript/funciones.js"></script>
</body>
</html>
