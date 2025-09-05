<?php
require_once 'componentes/conexiones.php';

$paquetes= $conexion->query("SELECT * FROM e_viajes WHERE paquete.estado = 'disponible';");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        foreach($paquetes as $paquete){
            echo $paquete['nombre'];
        }
    ?>
</body>
</html>