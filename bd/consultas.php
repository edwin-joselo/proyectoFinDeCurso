<?php
    //CALCULAR CÓDIGO MÁXIMO
    function calcular_max_PDO($conexion, $id, $tabla){
        $sql = 'SELECT MAX('.$id.') FROM '.$tabla; 
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            $max_cod = $fila[0];
            return $max_cod+=1;
        }
    }

    //USUARIO
    function listar_usuarios($conexion){
        $sql = 'SELECT * FROM usuarios';

        $resultado = $conexion->query($sql);   
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

    function insertar_usuario($conexion){
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $comunidad_autonoma = $_POST['comunidad_autonoma'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        $hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost' => 10]);

        $sql = 'INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, comunidad_autonoma, telefono, email, contrasenia) 
                VALUES ("'.$dni.'","'.$nombre.'","'.$apellidos.'","'.$fecha_nacimiento.'", "'.$comunidad_autonoma.'", '.$telefono.', "'.$email.'","'.$hash.'")';
        $resultado = $conexion->exec($sql);
        if($resultado){
            return true;
        } else {
            return false;
        }
    }

    function comprobar_usuario_bd($conexion){
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        $sql = 'SELECT email, contrasenia, dni FROM usuarios
                WHERE email = "'.$email.'"';

        $resultado = $conexion->query($sql);   
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

    //POLICIA
    function comprobar_policia_bd($conexion){
        $num_placa = $_POST['num_placa'];
        $contrasenia = $_POST['contrasenia'];

        $sql = 'SELECT num_placa, contrasenia FROM policias
                WHERE num_placa = "'.$num_placa.'"';
        $resultado = $conexion->query($sql);   
        if($fila = $resultado->fetch()){
            if(password_verify($contrasenia, $fila[1])){
                $_SESSION['policia'] = $fila[0];
                return true;
            } else {
                return false;
            }
        } 
    }

    //DENUNCIAS
    function insertar_denuncia($conexion) {
        $dni = $_SESSION['dni'];
        $fecha_delito = $_POST['fecha_delito'];
        $descripcion = $_POST['textarea'];
        if(!empty($_FILES['inputfile']['tmp_name'])){
            $foto = $_FILES['inputfile']['tmp_name'];
            $foto = base64_encode(file_get_contents(addslashes($foto)));
            $sql = 'INSERT INTO denuncias_previas(dni, descripcion, foto, fecha_delito) 
                    VALUES ("'.$dni.'","'.$descripcion.'","'.$foto.'","'.$fecha_delito.'")';
        }else{
            $sql = 'INSERT INTO denuncias_previas(dni, descripcion, fecha_delito) 
                    VALUES ("'.$dni.'","'.$descripcion.'","'.$fecha_delito.'")';
        }

        $resultado = $conexion->exec($sql);
    }

    function aceptar_denuncia($conexion, $codigo, $dni_denunciante, $delito, $num_placa, $descripcion_policia) {
        if($delito){
            $sql = 'UPDATE denuncias_previas SET aprobado = "si" WHERE cod = '.$codigo.'';
            $resultado = $conexion->query($sql); 
            if($resultado){
                $fecha = date("Y-m-d");
                try {
                    $sql = 'INSERT INTO denuncias(cod, fecha, dni_denunciante, delito, num_placa_policia, descripcion_policia) 
                            VALUES ('.$codigo.',"'.$fecha.'","'.$dni_denunciante.'", "'.$delito.'","'.$num_placa.'", "'.$descripcion_policia.'")';
                    $resultado = $conexion->exec($sql);
                } catch (PDOException $e) {
                    echo 'Error: ' . $e;
                }
            }
        } 
        
    }

    function rechazar_denuncia($conexion, $codigo) {
        $sql = 'UPDATE denuncias_previas SET aprobado = "no" WHERE cod = '.$codigo.'';
        $resultado = $conexion->query($sql); 
        if($resultado){
            return true;
        } else {
            return false;
        }
    }

    //DENUNCIAS SIN VERIFICAR
    function comprobar_denuncias_sin_verificar($conexion){
        $sql = 'SELECT * FROM denuncias_previas WHERE aprobado IS NULL';
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            mostrar_denuncias_sin_verificar($conexion);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function mostrar_denuncias_sin_verificar($conexion) {
        $sql = 'SELECT * FROM denuncias_previas WHERE aprobado IS NULL';
        $resultado = $conexion->query($sql);   
        while($fila = $resultado->fetch()){
            $cod = $fila['cod'];
            $dni = $fila['dni'];
            $descripcion = $fila['descripcion'];
            $fecha_delito = $fila['fecha_delito'];
            echo '
            <form action="'. $_SERVER['PHP_SELF'] .'" method="post">
                <div class="card">
                    <a name="'.$cod.'"></a>
                    <h4>Cod. denuncia: '.$cod.' </h4>
                    <p>DNI: '.$dni.'</p>
                    <p>Fecha: '.$fecha_delito.'</p>
                    <p>Descripción usuario: </p>
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
                    </div>
                    <p>Texto denuncia: </p>
                    <textarea name="descripcion_policia" rows="5"></textarea>';
                    echo '<div class="aceptar">
                        <input class="pointer" type="submit" name="aceptar_denuncia" value="aceptar"/>
                        <input class="pointer" type="submit" name="rechazar_denuncia" value="rechazar"/>
                    </div>
                </div>
            </form>';
        } 
    }

    //IMPRIMIR DENUNCIAS
    function consulta_select_imprimir_denuncias(){
        return 'SELECT * FROM denuncias_previas 
                INNER JOIN denuncias ON denuncias.cod = denuncias_previas.cod 
                INNER JOIN delitos ON denuncias.delito = delitos.cod 
                WHERE aprobado="si"';
    }

    function comprobar_imprimir_denuncias($conexion){
        $sql = consulta_select_imprimir_denuncias();
        $resultado = $conexion->query($sql);   
        if($fila = $resultado->fetch()){
            mostrar_imprimir_denuncias($conexion);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function mostrar_imprimir_denuncias($conexion) {
        $sql = consulta_select_imprimir_denuncias();
        $resultado = $conexion->query($sql);   
        while($fila = $resultado->fetch()){
            $cod = $fila[0];
            $dni = $fila['dni'];
            $descripcion = $fila['descripcion_policia'];
            $fecha_delito = $fila['fecha_delito'];
            $delito = $fila['nombre'];
            echo '
            <form action="./../pdf/generarPDF.php" method="post">
                <div class="card">
                    <a name="'.$cod.'"></a>
                    <h4>Cod. denuncia: '.$cod.' </h4>
                    <p>DNI: '.$dni.'</p>
                    <p>Fecha: '.$fecha_delito.'</p>
                    <input type="hidden" name="cod_denuncia" value="'.$cod.'"/>
                    <p>Delito: '.$delito.'</p>
                    <p>Descripción policía: </p>
                    <textarea readonly rows="5">'.$descripcion.'</textarea>
                    <div class="aceptar">
                            <input class="pointer" type="submit" name="generarPDF" value="Generar PDF"/>           
                    </div>
                </div>
            </form>';
        } 
    }

    //DENUNCIAS PREVIAS
    function comprobar_denuncias_previas($conexion, $usuario){
        $sql = 'SELECT dp.* 
                FROM usuarios u 
                INNER JOIN denuncias_previas dp
                ON u.dni = dp.dni
                WHERE u.dni = "'.$usuario.'" AND dp.aprobado IS NULL';
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            mostrar_denuncias_previas_usuario($conexion, $usuario);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function mostrar_denuncias_previas_usuario($conexion, $usuario){
        $sql = 'SELECT dp.* 
                FROM usuarios u 
                INNER JOIN denuncias_previas dp
                ON u.dni = dp.dni
                WHERE u.dni = "'.$usuario.'" AND dp.aprobado IS NULL';
        $resultado = $conexion->query($sql);
        while($fila = $resultado->fetch()){
            $cod = $fila['cod'];
            $fecha_delito = $fila['fecha_delito'];
            $descripcion = $fila['descripcion'];
            plantilla_card_denuncia($cod, $fecha_delito, $descripcion, 'card-previo');
        }
    }

    //DENUNCIAS APROBADAS
    function comprobar_denuncias_aprobadas($conexion, $usuario){
        $sql = 'SELECT d.*, dp.* 
                FROM denuncias d 
                INNER JOIN denuncias_previas dp
                ON d.cod = dp.cod
                WHERE dp.dni = "'.$usuario.'"';
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            mostrar_denuncias_aprobadas_usuario($conexion, $usuario);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function mostrar_denuncias_aprobadas_usuario($conexion, $usuario){
        $sql = 'SELECT d.*, dp.* 
                FROM denuncias d 
                INNER JOIN denuncias_previas dp
                ON d.cod = dp.cod
                WHERE dp.dni = "'.$usuario.'"';
        $resultado = $conexion->query($sql); 
        while($fila = $resultado->fetch()){
            $cod = $fila[0];
            $descripcion = $fila['descripcion'];
            $fecha_acontecimiento = $fila['fecha_delito'];
            $fecha_aprobacion = $fila['fecha'];
?>
            <div class="card card-aprobado">
                <h4>Cod. denuncia: <?php echo $cod; ?> </h4>
                <p>Fecha del delito:</p>
                <p class="fecha"><?php echo $fecha_acontecimiento ?></p>
                <p>Fecha de aprobación:</p>
                <p class="fecha"><?php echo $fecha_aprobacion ?></p>
                <p>Descripción: </p>
                <textarea readonly rows="5"> <?php echo $descripcion ?></textarea>
            </div>
<?php
        }
    }

    //DENUNCIAS RECHAZADAS
    function comprobar_denuncias_rechazadas($conexion, $usuario){
        $sql = 'SELECT dp.* 
                FROM usuarios u 
                INNER JOIN denuncias_previas dp
                ON u.dni = dp.dni
                WHERE u.dni = "'.$usuario.'" AND dp.aprobado="no"';
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            mostrar_denuncias_rechazadas_usuario($conexion, $usuario);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function mostrar_denuncias_rechazadas_usuario($conexion, $usuario){
        $sql = 'SELECT dp.* 
                FROM usuarios u 
                INNER JOIN denuncias_previas dp
                ON u.dni = dp.dni
                WHERE u.dni = "'.$usuario.'" AND dp.aprobado="no"';
        $resultado = $conexion->query($sql); 
        while($fila = $resultado->fetch()){
            $cod = $fila['cod'];
            $fecha_delito = $fila['fecha_delito'];
            $descripcion = $fila['descripcion'];
            plantilla_card_denuncia($cod, $fecha_delito, $descripcion, 'card-rechazado');
        }
    }

    //PLATILLA CARD DENUNCIAS
    function plantilla_card_denuncia($cod, $fecha_delito, $descripcion, $tipo){
?>
        <div class="card <?php echo $tipo ?>">
            <h4>Cod. denuncia: <?php echo $cod; ?> </h4>
            <p>Fecha del delito:</p>
            <p class="fecha"><?php echo $fecha_delito ?></p>
            <p>Descripción: </p>
            <textarea readonly rows="5"> <?php echo $descripcion ?></textarea>
        </div>
<?php
    }

    
    //DELITOS
    function consulta_select_delitos(){
        return 'SELECT * FROM delitos';
    }

    function comprobar_table_delitos($conexion){
        $sql = consulta_select_delitos();
        $resultado = $conexion->query($sql);
        if($fila = $resultado->fetch()){
            table_delitos($conexion);
        } else {
            echo '<p>No se han encontrado resultados.</p>';
        }
    }

    function insertar_delito($conexion){
        $nombre = $_POST['nombre'];
        $sql = 'INSERT INTO delitos(cod, nombre) 
                VALUES ('.calcular_max_PDO($conexion, 'cod', 'delitos').', "'.$nombre.'")';
        $resultado = $conexion->exec($sql);
        if($resultado){
            return true;
        } else {
            return false;
        }
    }

    function select_delitos($conexion) {
        $sql = consulta_select_delitos();
        $resultado = $conexion->query($sql); 
        while($fila = $resultado->fetch()){
            echo '<option value="'.$fila['cod'].'">'.$fila['nombre'].'</option>';
        }
    }

    function table_delitos($conexion){
        $sql = consulta_select_delitos();
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
    
    function eliminar_delito($conexion){
        $cod = $_POST['cod'];
        try {
            $sql = 'DELETE FROM delitos WHERE cod="'.$cod.'"';
            $resultado = $conexion->exec($sql);
            return true;
        } catch (PDOException $e) {
            $_SESSION['cod_delito'] = $_POST['cod'];
            return false;
        }
    }

    //FOTO
    function mostrar_foto($conexion, $codigo){
        $sql = 'SELECT * FROM denuncias_previas WHERE cod = '.$codigo.'';
        $resultado = $conexion->query($sql); 
        if($fila = $resultado->fetch()){
            $cod = $fila['cod'];
?>
            <script>
                Swal.fire({
                    title: 'Cod. denuncia: <?php echo $cod ?>',
                    html: '<img src="data:image/*;base64,<?php echo $fila['foto'] ?>"/>'
                });
            </script>
<?php
        }
    }

    //GRÁFICAS
    function colores(){
        return ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
        "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
        "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
        "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
        "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
        "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
        "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
        "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
        "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
        "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
        "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
        "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
        "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
        "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
        "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
        "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
        "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
        "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
        "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
        "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
        "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
        "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
        "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
        "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
        "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
        "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
        "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
        "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
        "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
        "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
        "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
        "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
        "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
        "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
        "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
        "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
        "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
        "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
        "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
        "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];
    }

    function datos_grafica_queso_ccaa($conexion){
        $sql = 'SELECT u.comunidad_autonoma, count(u.comunidad_autonoma) 
                FROM usuarios u 
                INNER JOIN denuncias_previas dp 
                ON u.dni = dp.dni 
                INNER JOIN denuncias d 
                ON dp.cod = d.cod 
                GROUP BY u.comunidad_autonoma';
        $resultado = $conexion->query($sql);
        $datos[0] = array('comunidad_autonoma','denuncias'); 
        $i = 1;
        while($fila = $resultado->fetch()){
            $datos[$i] = array($fila['0'], (int)$fila['1']);
            $i++;
        }
        return $datos;  
    }

    function datos_grafica_columnas_delitos($conexion){    
        $sql = 'SELECT del.nombre, count(del.nombre) 
                FROM delitos del 
                INNER JOIN denuncias den 
                ON del.cod = den.delito 
                GROUP BY del.nombre';
        $resultado = $conexion->query($sql);
        $colores = colores();
        $c = 0;
        while($row = $resultado->fetch()){
           echo '["'.$row[0].'", '.$row[1].',"'.$colores[$c].'"],';
            $c++;
        }
    }
