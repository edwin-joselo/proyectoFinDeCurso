<?php
require_once '../bd/conexion.php';
require_once '../bd/consultas.php';

session_start();

$conexion = abrir_conexion_PDO();

$cod = $_SESSION['cod_delito'];

$sql = 'SELECT dp.cod FROM denuncias_previas dp INNER JOIN denuncias d WHERE dp.cod = d.cod';
$resultado = $conexion->query($sql);
while($fila = $resultado->fetch()){
    $rechazada = rechazar_denuncia($conexion, $fila[0]);
}

if($rechazada){
    //Consulta de tipo DELETE
    $sql = 'DELETE FROM denuncias WHERE delito="'.$cod.'"';
    $resultado = $conexion->exec($sql);
}


//Consulta de tipo DELETE
$sql = 'DELETE FROM delitos WHERE cod="'.$cod.'"';
$resultado = $conexion->exec($sql);

unset($_SESSION['cod_delito']);

header('Location:../admin/delitos.php');