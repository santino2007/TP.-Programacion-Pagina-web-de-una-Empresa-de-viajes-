<?php 
require_once 'componentes/conexion.php';
(global variable) string $contrasenia

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar']))
$errores = '';
$correo = $conexion->real_escape_string(string: $_POST['nombre-usuario']);
$contrasenia = $conexion->real_escape_string(string: $_POST['contrasenia']);

if (empty($correo) || empty($contrasenia) ){
    $errores .= "<div class='alert alert-danger'>Por favor, completa todos los campos.</div>";
} else {
    $query = $conexion->prepare(query: 'SELECT * FROM usuarios WHERE email = ?');
    $query->bind_param(types: 's', var: &$correo);
    $query->execute();

    if ($query->get_result()->num_rows > 0) {
        $errores .= "<div class='alert alert-danger'>El correo ya esta registrado.</div>";
    }
}


?>