<?php
require_once '../bd/conexion.php';
require_once '../bd/consultas.php';

session_start();

$conexion = abrir_conexion_PDO();

$cod = $_SESSION['cod_delito'];
//Consulta de tipo DELETE
$sql = 'DELETE FROM denuncias WHERE delito="'.$cod.'"';
$resultado = $conexion->exec($sql);

if($resultado){

}

//Consulta de tipo DELETE
$sql = 'DELETE FROM delitos WHERE cod="'.$cod.'"';
$resultado = $conexion->exec($sql);

unset($_SESSION['cod_delito']);

header('Location:../admin/delitos.php');