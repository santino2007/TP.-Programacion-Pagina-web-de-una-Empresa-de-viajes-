<?php
require_once 'componentes/conexiones.php';

$paquetes = $conexion->query("SELECT * FROM e_viajes WHERE paquete.estado = 'disponible';");

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
    <div class="row row-cols-2 row-cols-md-3 g-3">
        <?php foreach ($paquetes as $paquete) { ?>
            <div class="col-md-6 col-ig-4 mb-4">
                <div class="cart">
                    <div class="d-flex flex-column">
                        <div class="cart-title">
                            <h3><?= $paquete['nombre'] ?></h3>
                        </div>
                        <div class="cart-body">
                            <img src="card-img-top" alt="<?=$paquete['imagen']?>" als="">
                            <h2><?= $paquete['decricion'] ?></h2>
                        </div>
                        <div class="cart-footer"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>