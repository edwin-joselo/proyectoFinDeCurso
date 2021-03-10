<?php

class bdconexion {

    protected function abrir_conexion_PDO() {
        //opciones
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        //conexion
        $conexion = new PDO('mysql:host=localhost;dbname=pruebaproyecto', 'proyecto', 'proyecto', $opciones);
        //Compruebo errores en la conexion
        
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }
    //No hace falta cerrar la conexion manualmente en PDO

    protected function calcular_max($id, $tabla, $consulta){
        //Consulta de tipo SELECT  
        $sql = 'SELECT MAX('.$id.') FROM '.$tabla; 
        $consulta->prepare($sql);
        $consulta->execute();
        //almaceno el resultado en variables
        $consulta->bind_result($max_cod);
        //obtenemos registro a registro
        while($consulta->fetch()) {
            return $max_cod+=1;
        }
    }
}