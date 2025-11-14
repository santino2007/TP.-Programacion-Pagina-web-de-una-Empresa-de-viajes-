<?php 
require_once 'componentes/conexion.php';
        (global variable) string $contrasenia

if ($_SERVER)

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