<?php 
require_once 'componentes/conexion.php';
(global variable) string $contrasenia

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar']))
$errores = '';
$correo = $conexion->real_escape_string(string: $_POST['nombre-usuario']);
$contrasenia = $conexion->real_escape_string(string: $_POST['contrasenia']);

if (empty($correo) || )


?>