<?php

    function abrir_conexion_PDO() {
        //opciones
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        //conexion
        $conexion = new PDO('mysql:host=localhost;dbname=pruebaproyecto', 'admin', 'admin', $opciones);
        //Compruebo errores en la conexion
        
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }
    //No hace falta cerrar la conexion manualmente en PDO