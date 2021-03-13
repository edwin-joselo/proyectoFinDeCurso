<?php 
    
    function mostrar_errores($errores) {
        echo '<ul>';
        foreach ($errores as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }
    
    function mostrar_value($value) {
        if(isset($_POST[$value])) {
            echo 'value="'.$_POST[$value].'"';
        }
    }
    
    function mostrar_error_campo($campo, $errores) {
        if(isset($errores[$campo])) {
            echo '<label class="label-errores">'.$errores[$campo].'</label>';
        }
    }
    
    function checked($name, $value) {
        if(isset($_POST[$name])){
            if ($_POST[$name] == $value) {
                echo "checked";
            }
        }
    }
    
    function selected($name, $value) {
        if(isset($_POST[$name])){
            if($_POST[$name] == $value) {
                echo 'selected';
            }
        }
    }
    
    function mostrar_text_area($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }    
    
    // function comprobar_campo_vacio($campo, $nombre_campo){
    //     if(empty($campo)){
    //        return 'El campo '.$nombre_campo.' no debe estar vacio';
    //     }
    // }
    
    // function comprobar_errores_registro($dni, $nombre, $apellidos, $fecha_nacimiento, $telefono, $email, $contrasenia, $repetir_contrasenia, $errores) {
    //     $error = [];
    //     $error['dni'] = comprobar_campo_vacio($dni, 'DNI');
    //     $error['nombre'] = comprobar_campo_vacio($nombre, 'Nombre');
    //     $error['apellidos'] = comprobar_campo_vacio($apellidos, 'Apellidos');
    //     $error['fecha_nacimiento'] = comprobar_campo_vacio($fecha_nacimiento, 'Fecha de nacimiento');
    //     $error['telefono'] = comprobar_campo_vacio($telefono, 'Teléfono');
    //     $error['email'] = comprobar_campo_vacio($email, 'Email');
    //     $error['contrasenia'] = comprobar_campo_vacio($contrasenia, 'Contraseña');
    //     $error['repetir_contrasenia'] = comprobar_campo_vacio($repetir_contrasenia, 'Repetir contraseña');

    //     return $error;
    // }
    
    function comprobar_errores_registro($dni, $nombre, $apellidos, $fecha_nacimiento, $telefono, $email, $contrasenia, $repetir_contrasenia, $errores) {
        if(empty($dni)){
            $errores['dni'] = 'El dni no debe estar vacio';
        } elseif(!preg_match("/^[0-9]{8}[A-Z]$/", $dni)){
            $errores['dni'] = 'El dni no cumple el patrón (ej: 23456789P)';
        }
        
        if(empty($nombre)){
            $errores['nombre'] = 'El nombre no debe estar vacio';
        } elseif(strlen($nombre) < 2){
            $errores['nombre'] = 'El nombre tiene que contener más de 2 caracteres (ej: Ed)';
        }

        if(empty($apellidos)){
            $errores['apellidos'] = 'Los apellidos no debe estar vacio';
        } elseif(strlen($apellidos) < 2){
            $errores['apellidos'] = 'El apellido tiene que contener más de 2 caracteres';
        }

        if(empty($fecha_nacimiento)){
            $errores['fecha_nacimiento'] = 'La fecha de nacimiento no debe estar vacio';
        }

        if(empty($telefono)){
            $errores['telefono'] = 'El telefono no debe estar vacio';
        } elseif(!preg_match("/^(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}$/", $telefono)){
            $errores['telefono'] = 'El telefono no cumple con los siguientes patrones (ej: 666777888)';
        }

        if(empty($email)){
            $errores['email'] = 'El email no debe estar vacio';
        }

        if(empty($contrasenia)){
            $errores['contrasenia'] = 'La contraseña no debe estar vacio';
        } elseif(strlen($contrasenia) < 6){
            $errores['contrasenia'] = 'La contraseña debe tener al menos 6 caracteres';
        } elseif (!preg_match("/[a-z]+/",$contrasenia)){
            $errores['contrasenia'] = 'La contraseña debe tener al menos una letra minúscula';
        } elseif (!preg_match("/[A-Z]+/",$contrasenia)){
            $errores['contrasenia'] = 'La contraseña debe tener al menos una letra mayúscula';
        } elseif (!preg_match("/[0-9]+/",$contrasenia)){
            $errores['contrasenia'] = "La contraseña debe tener al menos un caracter numérico";
        }

        if(empty($repetir_contrasenia)){
            $errores['repetir_contrasenia'] = 'El campo repetir contraseña no debe estar vacio';
        }

        if($contrasenia !== $repetir_contrasenia){
            $errores['contrasenias_iguales'] = 'Las contraseñas deben coincidir';
        }

        return $errores;
    }

    function comprobar_errores_login($email, $contrasenia, $errores){
        if(empty($email)){
            $errores['email'] = 'El email no puede estar vacio';
        }

        if(empty($contrasenia)){
            $errores['contrasenia'] = 'La contraseña no puede estar vacio';
        }

        return $errores;
    }
    
?>

