<?php 
require_once 'componentes/conexion.php';


if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'])) {
    $errores = '';
    $correo = $conexion->real_escape_string($_POST['nombre-us']);
    $contrasenia = $conexion->real_escape_string($_POST['contraseña']);

    if (empty($correo) || empty($contraseña)) {
        $errores .= "<div class='alert alert-danger'>por favor completa todos los campos</div>";
    } else {
        $frase = $conexion->prepare("SELECT * FROM usuarios WHERE usuarios.gmail = ?");
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
        <p>¿No tienes usuario? Registrate: <a href="registro.php">aqui</a> </p>
    </div>

    <script src=""></script>
</body>
</html>