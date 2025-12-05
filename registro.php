<?php
session_start();
require_once 'conexiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
$errores = '';
$nombre = $conexion->real_escape_string($_POST['nombre']);
$correo = $conexion->real_escape_string($_POST['nombre-usuario']);
$contrasenia = $conexion->real_escape_string($_POST['contrasenia']);

if (empty($correo) || empty($contrasenia) ){
    $errores .= "<div class='alert alert-danger'>Por favor, completa todos los campos.</div>";
} else {
    $query = $conexion->prepare('SELECT * FROM usuarios WHERE gmail = ?');
    $query->bind_param('s', $correo);
    $query->execute();

    if ($query->get_result()->num_rows > 0) {
        $errores .= "<div class='alert alert-danger'>El correo ya esta registrado.</div>";
    }
}
    if(empty($errores)){
        $contra_hash = password_hash($contrasenia, PASSWORD_BCRYPT);

        $query = $conexion->prepare(query: 'INSERT INTO usuarios (nombre_us, gmail, contraseña) VALUES (?,?,?)');
        $query->bind_param('sss', $nombre, $correo, $contra_hash);
        $sentencia = $query->execute();

        $query->close();
        $conexion->close();
    
        if($sentencia){
            $success = "<div class='alert alert-success'>Registro exitoso. Por favor, inicia sesion. </div>";
            header(header: 'Location: index.php');
        } else {
            $errores = "<div class='alert alert-danger'>Error en BBDD, pruebe mas tarde</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencia de viajes - Login</title>

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
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background: rgba(255,255,255,0.8);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>
    <form method="POST" action="registro.php">
        <?php require_once 'comp-form-login.php';?>
    </form>
    <div>
        <?php
            if (!empty($errores)) {
                echo $errores;
            }
            if (isset($success)) {
                echo $success;
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
