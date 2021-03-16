<?php

function insertar_usuario($conexion){
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contrasenia = $_POST['contrasenia'];

    $hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost' => 10]);

    //Consulta de tipo INSERT
    $sql = 'INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia) 
            VALUES ("'.$dni.'","'.$nombre.'","'.$apellidos.'","'.$fecha_nacimiento.'",'.$telefono.',"'.$email.'","'.$hash.'")';
    $resultado = $conexion->exec($sql);
    // echo '<p>Se han insertado '.$resultado.' registros.</p>';
    if($resultado){
        return true;
    } else {
        return false;
    }
}

function comprobar_usuario_bd($conexion){
    $email = $_POST['email'];
    $contrasenia = $_POST['contrasenia'];

    //Consulta de tipo SELECT            
    $sql = 'SELECT email, contrasenia, dni FROM usuarios
            WHERE email = "'.$email.'"';

    $resultado = $conexion->query($sql);   
    //utilizando fetch (array asociativo y numerico)
    if($fila = $resultado->fetch()){
        if(password_verify($contrasenia, $fila[1])){
            session_start();
            $_SESSION['dni'] = $fila[2];
            return true;
        } else {
            return false;
        }
    } 
}

function comprobar_policia_bd($conexion){
    $num_placa = $_POST['num_placa'];
    $contrasenia = $_POST['contrasenia'];

    //Consulta de tipo SELECT            
    $sql = 'SELECT num_placa, contrasenia FROM policias
            WHERE num_placa = "'.$num_placa.'"';

    $resultado = $conexion->query($sql);   
    //utilizando fetch (array asociativo y numerico)
    if($fila = $resultado->fetch()){
        if(password_verify($contrasenia, $fila[1])){
            session_start();
            $_SESSION['policia'] = $fila[0];
            return true;
        } else {
            return false;
        }
    } 
}

function insertar_denuncia($conexion) {
    $dni = $_SESSION['dni'];
    $fecha_delito = $_POST['fecha_delito'];
    $descripcion = $_POST['textarea'];
    $foto = $_FILES['inputfile']['tmp_name'];
    $foto = base64_encode(file_get_contents(addslashes($foto)));

    $sql = 'INSERT INTO denuncias_previas(dni, descripcion, foto, fecha_delito, aprobado) 
            VALUES ("'.$dni.'","'.$descripcion.'","'.$foto.'","'.$fecha_delito.'", "no")';
    $resultado = $conexion->exec($sql);
}

function listar_usuarios($conexion){
    // //Consulta de tipo SELECT            
    // $sql = 'SELECT * FROM usuarios';

    // $resultado = $conexion->query($sql);   
    // //utilizando fetch (array asociativo y numerico)
    // if($fila = $resultado->fetch()){
    //     echo 'Hola';
    // } 
}