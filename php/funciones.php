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
    
    function anio_diferencia($fecha){
        list($anio,$mes,$dia) = explode("-",$fecha);
        $anio_dif = date("Y") - $anio;
        $mes_dif = date("m") - $mes;
        $dia_dif = date("d") - $dia;

        if ($dia_dif < 0 || $mes_dif < 0) { 
            $anio_dif--; 
        } 
        
        return $anio_dif; 
    }
    
    function comprobar_errores_registro($dni, $nombre, $apellidos, $fecha_nacimiento, $telefono, $email, $contrasenia, $repetir_contrasenia, $errores) {
        $fecha_actual = date("Y-m-d");
        $fecha_nacimiento_date = date("Y-m-d", strtotime($fecha_nacimiento));

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

        elseif($fecha_actual < $fecha_nacimiento_date){
            $errores['fecha_delito'] = 'Seleccione una fecha del pasado';
        }

        elseif(anio_diferencia($fecha_nacimiento) < 18){
            $errores['fecha_delito'] = 'Debes ser mayor de edad para poder registrarte';
        }

        elseif(anio_diferencia($fecha_nacimiento) > 120){
            $errores['fecha_delito'] = 'Fecha muy lejana';
        }

        if(empty($telefono)){
            $errores['telefono'] = 'El telefono no debe estar vacio';
        } elseif(!preg_match("/^(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}$/", $telefono)){
            $errores['telefono'] = 'El telefono no cumple con los siguientes patrones (ej: 666777888)';
        }

        if(empty($email)){
            $errores['email'] = 'El email no debe estar vacio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores['email'] = 'El email no es correcto. (ej: ejemplo@ejemplo.com)';
        } elseif (strlen($email) >  40){
            $errores['email'] = 'El email es muy largo. (ej: ejemplo@ejemplo.com)';
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
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores['email'] = 'El email no es correcto. (ej: ejemplo@ejemplo.com)';
        }

        if(empty($contrasenia)){
            $errores['contrasenia'] = 'La contraseña no puede estar vacio';
        }

        return $errores;
    }

    function comprobar_errores_login_policia($num_placa, $contrasenia, $errores){
        if(empty($num_placa)){
            $errores['num_placa'] = 'El número de placa no puede estar vacio';
        }

        if(empty($contrasenia)){
            $errores['contrasenia'] = 'La contraseña no puede estar vacio';
        }

        return $errores;
    }

    function comprobar_errores_denuncia($fecha_delito, $descripcion, $inputfile, $errores){
        $fecha_actual = date("Y-m-d");
        $fecha_delito_date = date("Y-m-d", strtotime($fecha_delito));

        if(empty($fecha_delito)){
            $errores['fecha_delito'] = 'Seleccione una fecha';
        }

        elseif($fecha_actual < $fecha_delito_date){
            $errores['fecha_delito'] = 'Seleccione una fecha del pasado';
        }

        elseif(anio_diferencia($fecha_delito) > 10){
            $errores['fecha_delito'] = 'La fecha es muy lejana ('.anio_diferencia($fecha_delito).' años) y el máximo es de 10 años';
        }

        if(empty($descripcion)){
            $errores['descripcion'] = 'Añada una descripción';
        }

        if(!empty($_FILES['inputfile']['tmp_name'])){
            if(filesize($inputfile)> 800000){
                $errores['inputfile'] = 'Imagen demasiado grande';
            }
        }

        return $errores;
    }

    function comprobar_error_delito($nombre, $errores){
        if(empty($nombre)){
            $errores['nombre'] = 'El nombre del delito no puede estar vacio';
        }
        return $errores;
    }
?>

