<?php
session_start();

require_once '../bd/conexion.php';
require_once '../bd/consultas.php';

$conexion = abrir_conexion_PDO();

$cod = $_SESSION['cod_delito'];

$sql = 'SELECT dp.cod 
        FROM denuncias_previas dp 
        INNER JOIN denuncias d 
        ON dp.cod = d.cod
        WHERE d.delito = '.$cod;
$resultado = $conexion->query($sql);
while($fila = $resultado->fetch()){
    $rechazada = rechazar_denuncia($conexion, $fila[0]);
}

if($rechazada){
    $sql = 'DELETE FROM denuncias WHERE delito="'.$cod.'"';
    $resultado = $conexion->exec($sql);
}

$sql = 'DELETE FROM delitos WHERE cod="'.$cod.'"';
$resultado = $conexion->exec($sql);

unset($_SESSION['cod_delito']);

header('Location:../admin/delitos.php');