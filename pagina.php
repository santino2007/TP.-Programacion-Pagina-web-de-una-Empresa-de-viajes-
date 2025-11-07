<?php
require_once 'conexiones.php';

// Consulta paquetes activos
$paquetes = $conexion->query("SELECT * FROM planes WHERE planes.estado = 'activo';");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tours Emprender</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

<style>
/* ====== Colores pastel ====== */
:root {
    --color-rosa: #ffcad4;
    --color-celeste: #aee6e6;
    --color-amarillo: #ffd6a5;
    --color-lila: #cdb4db;
    --color-verde: #b9fbc0;
    --color-fondo: #fefcfb;
    --color-texto: #444;
}

/* ====== Estilos generales ====== */
body {
    background-color: var(--color-fondo);
    color: var(--color-texto);
    font-family: "Poppins", sans-serif;
    padding-top: 80px;
}

.card {
    background-color: #fffafc;
    border: 1px solid #f5e6e8;
    border-radius: 20px;
    transition: transform .18s ease, box-shadow .18s ease;
}
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.card-title {
    color: #444;
    font-weight: 600;
}
.quantity-input { width: 80px; }
.modal-img { max-height: 220px; object-fit: cover; width:100%; border-radius:10px; }

/* ====== Navbar ====== */
.navbar {
    background-color: var(--color-rosa) !important;
    border-bottom: 2px solid #ffdce5;
}
.navbar-brand {
    font-weight: 700;
    color: #444 !important;
}
.nav-link {
    color: #333 !important;
    font-weight: 500;
}
.nav-link:hover {
    color: #000 !important;
}

/* ====== Botones pastel ====== */
.btn-primary {
    background-color: var(--color-celeste);
    border: none;
    color: #333;
    font-weight: 600;
}
.btn-primary:hover {
    background-color: #9edede;
}
.btn-success {
    background-color: var(--color-verde);
    border: none;
    color: #333;
    font-weight: 600;
}
.btn-success:hover {
    background-color: #a2f5ab;
}
.btn-outline-primary {
    border-color: var(--color-lila);
    color: var(--color-lila);
}
.btn-outline-primary:hover {
    background-color: var(--color-lila);
    color: #fff;
}

/* ====== Estrellas ====== */
.stars {
    display: flex;
    gap: 4px;
    cursor: pointer;
}
.star {
    font-size: 1.4rem;
    color: #ddd;
    transition: color 0.2s;
}
.star.selected {
    color: #f7b267;
}
.star:hover,
.star:hover ~ .star {
    color: #f7b267;
}

/* ====== Modal ====== */
.modal-content {
    border-radius: 20px;
    background-color: #fff9fb;
}
.modal-header {
    background-color: #ffeef3;
    border-bottom: none;
}
.modal-footer {
    background-color: #fff5f7;
    border-top: none;
}
</style>
</head>
<body>

<!-- ====== Navbar ====== -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Tour Emprende 🌸</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del menú -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Inicio -->
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Inicio</a></li>

                <!-- Compartir -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#shareModal">Compartir</a>
                </li>

                <!-- Dropdown configuración / asistente -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menú</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Configuración ⚙️</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Asistente 🤖</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Botones sesión y carrito -->
            <div class="d-flex align-items-center gap-2">
                <button onclick="iniciarSesion()" type="button" class="btn btn-primary fw-bold rounded-pill shadow-sm px-4 py-2">
                    Iniciar sesión
                </button>

                <button type="button" class="btn btn-outline-primary position-relative" data-bs-toggle="modal" data-bs-target="#cartModal" id="openCartBtn">
                    🛒 Ver Carrito
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCountBadge" style="display:none;">0</span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- ====== Modal Compartir ====== -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="shareModalLabel">Compartir enlace 💌</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <label for="shareUrl" class="form-label small">Copia este enlace y compártelo</label>
                <div class="input-group">
                    <input type="text" id="shareUrl" class="form-control" readonly>
                    <button class="btn btn-outline-primary" id="copyShareBtn" type="button">Copiar</button>
                </div>
                <div id="copyFeedback" class="small text-success mt-2" style="display:none;">Enlace copiado ✅</div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Modal Carrito ====== -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="cartModalLabel">🛍️ Tu Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="cartContent"></div>
                <div id="cartEmpty" class="text-center text-muted">No hay productos en el carrito.</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Seguir comprando</button>
                <button class="btn btn-success" id="checkoutBtn">Comprar</button>
            </div>
        </div>
    </div>
</div>

<!-- ====== Cards de paquetes ====== -->
<div class="container mt-3">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        if ($paquetes && $paquetes->num_rows > 0) {
            foreach($paquetes as $paquete) {
                $id = $paquete['id_planes'] ?? '';
                $nombre = htmlspecialchars($paquete['nom_planes'] ?? 'Sin nombre');
                $precio = htmlspecialchars($paquete['precio'] ?? '0');
                $f_inicio = htmlspecialchars($paquete['f_inicio'] ?? '');
                $f_fin = htmlspecialchars($paquete['f_fin'] ?? '');
                $imagen = $paquete['imagen'] ?? $paquete['foto'] ?? "https://picsum.photos/seed/paquete{$id}/480/260";
                $descripcion = htmlspecialchars($paquete['descripcion'] ?? 'No hay descripción disponible.');
                $data_attrs = "data-id='$id' data-nombre='$nombre' data-precio='$precio' data-fechas='Inicio: $f_inicio — Fin: $f_fin' data-imagen='$imagen' data-descripcion='$descripcion'";
        ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="<?= $imagen ?>" class="card-img-top" alt="<?= $nombre ?>" style="height:200px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $nombre ?></h5>
                    <p class="mb-1 small text-muted">Inicio: <?= $f_inicio ?> — Fin: <?= $f_fin ?></p>

                    <!-- Estrellas seleccionables -->
                    <div class="stars mb-2" data-id="<?= $id ?>">
                        <?php for ($i=1; $i<=5; $i++): ?>
                            <span class="star" data-value="<?= $i ?>">★</span>
                        <?php endfor; ?>
                    </div>

                    <div class="mt-auto">
                        <h5 class="text-success">Precio: <?= $precio ?></h5>

                        <div class="d-flex gap-2 mt-3">
                            <button type="button" class="btn btn-outline-primary flex-grow-1 btn-description" <?= $data_attrs ?> data-bs-toggle="modal" data-bs-target="#descriptionModal">Descripción</button>
                            <input type="number" min="1" value="1" class="form-control quantity-input" id="qty_<?= $id ?>">
                            <button type="button" class="btn btn-success btn-add-cart" <?= $data_attrs ?>>Agregar</button>
                        </div>

                        <div class="mt-2">
                            <a href="index3.php?id=<?= urlencode($id) ?>" class="btn btn-primary w-100 fw-bold rounded-pill">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }} else { ?>
            <div class="col-12"><div class="alert alert-info">No hay paquetes activos.</div></div>
        <?php } ?>
    </div>
</div>

<!-- ====== Bootstrap JS ====== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ---------- Estrellas seleccionables ---------- */
document.addEventListener('click', function(e) {
    const star = e.target.closest('.star');
    if (!star) return;
    const container = star.parentElement;
    const value = parseInt(star.dataset.value);
    [...container.children].forEach(s => s.classList.remove('selected'));
    for (let i = 0; i < value; i++) container.children[i].classList.add('selected');
});

/* ---------- Iniciar sesión ---------- */
function iniciarSesion() {
    alert('Función iniciar sesión: aquí puedes colocar tu propio login.');
}
</script>

</body>
</html>