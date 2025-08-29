<?php
session_start();

// Inicializar carrito
if(!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$mensajeCompra = "";

// Agregar al carrito
if(isset($_POST['accion']) && $_POST['accion'] == "agregar") {
    $item = [
        "id" => uniqid(),
        "destino" => $_POST['destino'],
        "precio" => $_POST['precio']
    ];
    $_SESSION['carrito'][] = $item;
}

// Eliminar del carrito
if(isset($_POST['accion']) && $_POST['accion'] == "eliminar") {
    $id = $_POST['id'];
    foreach($_SESSION['carrito'] as $key => $item) {
        if($item['id'] === $id) {
            unset($_SESSION['carrito'][$key]);
        }
    }
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}

// Finalizar compra
if(isset($_POST['accion']) && $_POST['accion'] == "finalizar") {
    $_SESSION['carrito'] = [];
    $mensajeCompra = "¡Gracias por tu compra! Recibirás un correo con los detalles.";
}

// Variables carrito
$cantidadCarrito = count($_SESSION['carrito']);
$total = 0;
foreach($_SESSION['carrito'] as $item) {
    $total += $item['precio'];
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Emprende</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tours Emprende</a>
            <div class="ms-auto">
                <button type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#carritoModal">
                    Carrito
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $cantidadCarrito; ?>
                    </span>
                </button>
            </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
        $destinos = "Barcelona - Disfruta de las playas, la Sagrada Familia y la mejor comida mediterránea.|París - Vive el romance en la ciudad de la luz y visita la Torre Eiffel.|Roma - Recorre el Coliseo y disfruta de la auténtica pasta italiana.|Cancún - Relájate en sus playas paradisíacas y explora las ruinas mayas.|Bariloche - Descubre la belleza de la Patagonia y sus lagos cristalinos.|Tokio - Vive la mezcla perfecta entre tradición y tecnología futurista.|El Cairo - Explora las pirámides y la historia milenaria del Nilo.|Río de Janeiro - Baila samba en el carnaval y disfruta de la playa de Copacabana.|Atenas - Recorre la Acrópolis y siente la cuna de la civilización.|Nueva York - Conquista la Gran Manzana y vive la ciudad que nunca duerme.";
        
        $listaDestinos = explode("|", $destinos);

        for($i = 0; $i < 6; $i++) {
            $destinoAleatorio = $listaDestinos[array_rand($listaDestinos)];
            $precio = rand(500, 2500);
            $modalId = "modalDestino".$i;
    ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://picsum.photos/300/200?random=<?php echo $i; ?>" class="card-img-top" alt="Destino">
                <div class="card-body">
                    <h5 class="card-title">Destino turístico</h5>
                    <p class="card-text"><?php echo $destinoAleatorio; ?></p>
                    <p class="fw-bold text-primary">$<?php echo $precio; ?> USD</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                    Comprar
                    </button>
                </div>
            </div>
        </div>

    <!-- MODAL COMPRA -->
    <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                <h5 class="modal-title">Confirmar compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <p><?php echo $destinoAleatorio; ?></p>
                <p class="fw-bold">Precio: $<?php echo $precio; ?> USD</p>
                <input type="hidden" name="destino" value="<?php echo $destinoAleatorio; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                <input type="hidden" name="accion" value="agregar">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Agregar al carrito</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <?php } ?>
    </div>
</div>

<!-- MODAL CARRITO -->
<div class="modal fade" id="carritoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Carrito de compras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <?php if($cantidadCarrito > 0): ?>
                <ul class="list-group mb-3">
                <?php foreach($_SESSION['carrito'] as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo $item['destino']; ?></span>
                    <div>
                        <span class="fw-bold text-primary me-3">$<?php echo $item['precio']; ?> USD</span>
                        <form method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                    </li>
                <?php endforeach; ?>
                </ul>
                <h5 class="text-end">Total: <span class="fw-bold text-success">$<?php echo $total; ?> USD</span></h5>
            <?php else: ?>
                <p class="text-muted">El carrito está vacío.</p>
            <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?php if($cantidadCarrito > 0): ?>
                    <form method="post" class="d-inline">
                    <input type="hidden" name="accion" value="finalizar">
                    <button type="submit" class="btn btn-success">Finalizar compra</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- TOAST -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
    <div id="compraToast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <?php echo $mensajeCompra; ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if($mensajeCompra): ?>
    var toast = new bootstrap.Toast(document.getElementById('compraToast'))
    toast.show();
<?php endif; ?>
</script>

</body>
</html>