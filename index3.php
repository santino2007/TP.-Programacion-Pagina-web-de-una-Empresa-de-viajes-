<?php
require_once 'conexiones.php';

$paquetes = $conexion->query("SELECT * FROM planes WHERE planes.estado = 'activo';");

?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $id_planes =isset($_GET['id']) ? intval($_GET['id']):0;

            if ($id_planes !=null && $id_planes > 0) {
                require_once 'conexiones.php';

            }
            $paquete = $conexion->query("
            SELECT * WHERE paquetes.id_planes = $id_planes AND (paquetes.estado= 'disponible' OR paquetes.estado = 'proximo')"
            )->fetch_assoc();
            if (!$paquete){
                echo"div class='alerta alerta-danger'>paquete no encontrado o no disponible.<div>";
                exit;
            }else{
                $servidor = $conexion->query("
                SELECT * FROM selvicios JOIN planes_srvicio ON servicio asociados y calcula todo  ");
        }
    ?>
<main class="flex-shrink-0 py-4">
    <div class="container d-flex justify-content-center">
        <div class="cart text-white">

        </div>
    </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>