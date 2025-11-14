<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])){
        $errores = '';
        $correos = $conexion->real_escape_string($_POST['nombre-usuario']);
        $contrasenia = $conexion->real_escape_string($_POST['contrasenia']);

        if(empty($correo) || empty($contrasenia)){
            $errores .= "<div class='alert alert-danger'>por favor completa todos los campos</div>";
        } else {
            $frase = $conexion->prepare("SELECT * FROM usuarios WHERE usuarios.gmail = ?");
            $frase->bind_param('s', $correo);
            $frase->execute();
            $usuario = $frase->get_result()->fetch_asspc();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="nombre-usuario">Nombre de usuario</label>
        <input type="email" name="nombre-usuario" id="nombre.usuario">
        <label for="contrasenia">contraseña</label>
        <input type="password" name="nombre-usuario" id="nombre.usuario">
    </form>
</body>
</html>