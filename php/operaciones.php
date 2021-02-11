<?php
require_once '../bd/conexion.php';
$tipo_operacion = $_POST['tipo_operacion'];
switch ($tipo_operacion) {
    case 'insertar':
        echo json_encode('le he dado en insertar');
        
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