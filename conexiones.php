<?php
$servidor="localhost";
$usuario = "root";
$contraseña="";
$base="";

//
$conexion=new mysqli($servidor,$usuario ,$contraseña,$base);

if($conexion->connect_error){
    die("error de conexión: " . $conexion->connect_error);
}

//<?php//
require_once "componentes/conexion.php";

$paquetes = $conexion->query("");

?>
