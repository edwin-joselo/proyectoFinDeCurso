<?php

function insertar_usuario($conexion){
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contrasenia = $_POST['contrasenia'];

    //Consulta de tipo INSERT
    $sql = 'INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia) 
            VALUES ("'.$dni.'","'.$nombre.'","'.$apellidos.'","'.$fecha_nacimiento.'",'.$telefono.',"'.$email.'","'.$contrasenia.'")';
    $resultado = $conexion->exec($sql);
    // echo '<p>Se han insertado '.$resultado.' registros.</p>';
    if($resultado){
        header('Location:login.php');
    }
}