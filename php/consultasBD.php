<?php

class consultas extends bdconexion {

    public function selectPersonas(){

        // $conexion = bdconexion::abrir_conexion_PDO();

        // //Consulta de tipo SELECT            
        $sql = 'SELECT * FROM personas';
        // $resultado = $conexion->query($sql);   

        
        // //utilizando fetch (array asociativo y numerico)
        // while($fila = $resultado->fetch()){
        //     return $fila;
        // }

        $sqlp = bdconexion::abrir_conexion_PDO()->prepare($sql);
        $sqlp->execute();
        return $array = $sqlp->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarPersona($dni, $nombre, $apellidos, $fecha_nacimiento ,$telefono, $email, $contrasenia){

        // $conexion = bdconexion::abrir_conexion_PDO();

        // //Consulta de tipo INSERT
        // $sql='INSERT INTO personas(dni, nombre, apellidos, telefono, email, contrasenia) 
        // // VALUES ("'.$dni.'","'.$nombre.'","'.$apellidos.'",'.$telefono.',"'.$email.'","'.$contrasenia.'")';
        // $resultado = $conexion->exec($sql);

        // if($resultado->rowCount() > 0){
        //     $consulta = self::selectPersonas();
        //     return $consulta;
        // } else {
        //     return 'error';
        // }

        $sql = bdconexion::abrir_conexion_PDO()->prepare("INSERT INTO personas(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia)VALUES('$dni', '$nombre', '$apellidos', '$fecha_nacimiento',$telefono, '$email', '$contrasenia')");
        if($sql->execute()) {
            $resultado = self::selectPersonas();
            return $resultado;
        }

    }
}

?>