<?php
require_once '../bd/conexion.php';
require_once './consultasBD.php';
$tipo_operacion = $_POST['tipo_operacion'];
switch ($tipo_operacion) {
    case 'insertar':
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        $consultas = new consultas();

        $errores = [];
        if(empty($dni)){
            $errores = 'Error dni';
        }

        if($errores){
            echo json_encode($errores);

        } else {

            $ejecutar = $consultas->insertarPersona($dni, $nombre, $apellidos, $fecha_nacimiento, $telefono, $email, $contrasenia);
            echo json_encode($ejecutar);
        }
        
    

        
        break;
        
    case 'loguear':
        echo json_encode('le he dado en insertar');
        
        break;
            
    case 'borrar':
        echo json_encode('le he dado en insertar');
        
        break;
                
    case 'editar':
        echo json_encode('le he dado en insertar');

        break;
    
    default:
        # code...
        break;
}