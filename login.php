<?php 
require_once 'conexiones.php';

if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
    $errores = '';
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $correo = $conexion->real_escape_string($_POST['nombre-usuario']);
    $contrasenia = $conexion->real_escape_string($_POST['contrasenia']);

    if (empty($correo) || empty($contrasenia)) {
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
            $_SESSION['nombre'] = $usuario['nombre_us'];
            $_SESSION['gmail'] = $usuario['gmail'];
            $conexion->close();
            header('Location: index.php');
            exit;
        } else {
            $errores .= "<div class='alert alert-danger'>La contraseña es incorrecta</div>";
            header('Location: login.php');
            echo $errores;
            exit;
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
    <style>
      
        body {
            background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

       
        form {
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgb(0, 0, 0);
            width: 300px;
            margin: 50px auto;
        }

        
        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color:rgb(6, 41, 238);
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div>
        <?php
            if (!empty($errores)) {
                echo $errores;
            }
        ?>
    </div>
    <form method="POST" action="login.php">
        <?php require_once 'comp-form-login.php'; ?>
    </form>

    <div class="register-link">
        <p>¿No tienes usuario? Registrate: <a href="registro.php">aquí</a></p>
    </div>
    <script src=""></script>

</body>
</html>