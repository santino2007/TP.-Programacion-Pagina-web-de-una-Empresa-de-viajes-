<?php 
require_once 'conexiones.php';

if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
    $errores = '';
    $correo = $conexion->real_escape_string($_POST['nombre-usuario']);
    $contrasenia = $conexion->real_escape_string($_POST['contrasenia']);

    if (empty($correo) || empty($contrasenia)) {
        $errores .= "<div class='alert alert-danger'>por favor completa todos los campos</div>";
    } else {
        $frase = $conexion->prepare("SELECT * FROM usuarios WHERE usuarios.gmail = ?,");
        $frase->bind_param('s', $correo);
        $frase->execute();

    }
    $usuario = $frase->get_result()->fetch_assoc();
    if ($usuario) {
        if (password_verify($contrasenia, $usuario['contraseña'])) {
            session_start();
            $_SESSION['usuario'] = $usuario['id_usuario'];

            $conexion->close();
            header('Location: index.php');
            exit;
        } else {
            $errores .= "<div class='alert alert-danger'>La contraseña es incorrecta</div>";
        }
    } else {
        $errores .= "<div class='alert alert-danger'>El usuario no existe</div>";
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
        <?php require_once 'comp-form-login.php'; ?>
    </form>
    <div>
        <p>¿No tienes usuario? Registrate: <a href="registros.php">aqui</a> </p>
    </div>

    <script src=""></script>
</body>
</html>