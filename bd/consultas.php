<?php
    function calcular_max_PDO($id, $tabla, $conexion){
        //Consulta de tipo SELECT  
        $sql = 'SELECT MAX('.$id.') FROM '.$tabla; 
        $resultado = $conexion->query($sql);
        //obtenemos registro a registro
        if($fila = $resultado->fetch()){
            $max_cod = $fila[0];
            return $max_cod+=1;
        }
    }

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
                // session_start();
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
        if(!empty($_FILES['inputfile']['tmp_name'])){
            $foto = $_FILES['inputfile']['tmp_name'];
            $foto = base64_encode(file_get_contents(addslashes($foto)));
            $sql = 'INSERT INTO denuncias_previas(dni, descripcion, foto, fecha_delito, aprobado) 
                    VALUES ("'.$dni.'","'.$descripcion.'","'.$foto.'","'.$fecha_delito.'", "no")';
        }else{
            $sql = 'INSERT INTO denuncias_previas(dni, descripcion, fecha_delito, aprobado) 
                    VALUES ("'.$dni.'","'.$descripcion.'","'.$fecha_delito.'", "no")';
        }

        $resultado = $conexion->exec($sql);
    }

    function listar_usuarios($conexion){
        //Consulta de tipo SELECT            
        $sql = 'SELECT * FROM usuarios';

        $resultado = $conexion->query($sql);   
        //utilizando fetch (array asociativo y numerico)
        while($fila = $resultado->fetch()){
            echo '<tr>';
                echo '<td>'.$fila['dni'].'</td>';
                echo '<td>'.$fila['nombre'].'</td>';
                echo '<td>'.$fila['apellidos'].'</td>';
                echo '<td>'.$fila['fecha_nacimiento'].'</td>';
                echo '<td>'.$fila['telefono'].'</td>';
                echo '<td>'.$fila['email'].'</td>';
            echo '</tr>';
        } 
    }

    function mostrar_denuncias($conexion) {
        $sql = 'SELECT * FROM denuncias_previas';
        $resultado = $conexion->query($sql);   
        //utilizando fetch (array asociativo y numerico)
        while($fila = $resultado->fetch()){
            if ($fila['aprobado']=== 'no'){
                $cod = $fila['cod'];
                $dni = $fila['dni'];
                $descripcion = $fila['descripcion'];
                $fecha_delito = $fila['fecha_delito'];
                echo '
                <form action="'. $_SERVER['PHP_SELF'] .'" method="post">
                    <div class="card">
                        <h4>Cod. denuncia: '.$cod.' </h4>
                        <p>DNI: '.$dni.'</p>
                        <p>Fecha: '.$fecha_delito.'</p>
                        <p>Descripción: </p>
                        <textarea readonly rows="5">'.$descripcion.'</textarea>
                        <input type="hidden" name="cod" value="'.$fila['cod'].'"/>
                        <input type="hidden" name="dni" value="'.$fila['dni'].'"/>';
                        if(!is_null($fila['foto'])){
                            echo '<label class="pointer" for="foto'.$fila['cod'].'"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="camera" class="svg-inline--fa fa-camera fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 144v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h88l12.3-32.9c7-18.7 24.9-31.1 44.9-31.1h125.5c20 0 37.9 12.4 44.9 31.1L376 96h88c26.5 0 48 21.5 48 48zM376 288c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88z"></path></svg></label>';
                            echo '<input type="submit" id="foto'.$fila['cod'].'" name="mostrar_foto" value="foto"/>';
                        }
                        echo '<div class="tipo-delito">
                            Seleccione el delito: </br>
                            <select name="delito">';
                            select_delitos($conexion);
                        echo '</select>
                        </div>';
                        echo '<div class="aceptar">
                            <input class="pointer" type="submit" name="aceptar_denuncia" value="aceptar"/>
                            <input class="pointer" type="submit" name="rechazar_denuncia" value="rechazar"/>
                        </div>
                    </div>
                </form>';
            }
        } 

    }

    function select_delitos($conexion) {
        $sql = 'SELECT * FROM delitos';
        $resultado = $conexion->query($sql); 
        while($fila = $resultado->fetch()){
            echo '<option value="'.$fila['cod'].'">'.$fila['nombre'].'</option>';
        }
    }

    function table_delitos($conexion){
        $sql = 'SELECT * FROM delitos';
        $resultado = $conexion->query($sql); 
        echo '<div class="contenedor-tabla">';
        echo '<table class="tabla-delitos" align="center">';
        while($fila = $resultado->fetch()){
            ?>
            <tr>
                <td> 
                    <label><?php echo $fila['nombre'] ?> </label>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="cod" value="<?php echo $fila['cod']; ?>">
                        <input type="submit" name="eliminar" value="X">
                    </form>
                </td>
            </tr>
            <?php
        }
        echo '</table>';
        echo '</div>';
    }

    function insertar_delito($conexion){
        $nombre = $_POST['nombre'];

        //Consulta de tipo INSERT
        $sql = 'INSERT INTO delitos(cod, nombre) 
                VALUES ('.calcular_max_PDO('cod', 'delitos', $conexion).', "'.$nombre.'")';
        $resultado = $conexion->exec($sql);
        if($resultado){
            return true;
        } else {
            return false;
        }
    }

    function eliminar_delito($conexion){
        $cod = $_POST['cod'];
        try {
            //Consulta de tipo DELETE
            $sql = 'DELETE FROM delitos WHERE cod="'.$cod.'"';
            $resultado = $conexion->exec($sql);
            return true;
        } catch (PDOException $e) {
            $_SESSION['cod_delito'] = $_POST['cod'];
            return false;
        }
    }

    function mostrar_foto($conexion, $codigo){
        $sql = 'SELECT * FROM denuncias_previas WHERE cod = '.$codigo.'';
        $resultado = $conexion->query($sql); 
        if($fila = $resultado->fetch()){
            $foto = '<img src="data:image/*;base64,'.$fila['foto'].'" />';
            $cod = $fila['cod'];
            ?>
            <script>
                Swal.fire({
                    title: 'Cod. denuncia: <?php echo $cod ?>',
                    html: '<img src="data:image/*;base64,<?php echo $fila['foto'] ?>" />'
                });
            </script>
            <?php
        }
    }

    function aceptar_denuncia($conexion, $codigo, $dni_denunciante, $delito, $num_placa) {
        $sql = 'UPDATE denuncias_previas SET aprobado = "si" WHERE cod = '.$codigo.'';
        $resultado = $conexion->query($sql); 
        if($resultado){
            $fecha = date("Y-m-d");
            $sql= 'INSERT INTO denuncias(cod, fecha, dni_denunciante, delito, num_placa_policia) 
            VALUES ('.$codigo.',"'.$fecha.'","'.$dni_denunciante.'", "'.$delito.'","'.$num_placa.'")';
            $resultado = $conexion->exec($sql);
        }
    }
