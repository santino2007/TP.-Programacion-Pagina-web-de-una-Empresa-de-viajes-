<?php
$servidor="localhost";
$usuario = "root";
$contrasenia="";
$base="e_viajes";

//
$conexion= new mysqli($servidor,$usuario ,$contrasenia,$base);

if($conexion->connect_error){
    die("error de conexión: " . $conexion->connect_error);
}

