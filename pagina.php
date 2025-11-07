<?php
require_once 'conexiones.php';
$paquetes = $conexion->query("SELECT * FROM planes WHERE estado = 'activo';");
?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tours Emprender</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
                /* 🎨 Colores pastel suaves */
                body {
                        background-color: #f7f9fb;
                        color: #333;
                        padding-top: 80px;
                }
                .navbar {
                        background-color: #b8d8d8 !important;
                }
                .card {
                        background-color: #ffffff;
                        border: none;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                        border-radius: 15px;
                        transition: transform 0.2s;
                }
                .card:hover {
                        transform: scale(1.02);
                }
                .btn-success {
                        background-color: #a0d995;
                        border: none;
                }
                .btn-success:hover {
                        background-color: #8bc48a;
                }
                .modal-content {
                        border-radius: 10px;
                }
                .estrella {
                        color: #ddd;
                        font-size: 1.5rem;
                        cursor: pointer;
                }
                .estrella.seleccionada {
                        color: gold;
                }
        </style>
</head>

<body>

<!-- 🧭 Navbar superior -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">🌎 Tour Emprende</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>

                <!-- Botón Compartir -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalCompartir">Compartir</a>
                </li>

                <!-- Dropdown Configuración / Asistente -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown">Menú</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Asistente</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Botones de sesión y carrito -->
            <button class="btn btn-primary me-2">Iniciar sesión</button>
            <button onclick="abrirCarrito()" class="btn btn-outline-success">🛒 Ver Carrito</button>
        </div>
    </div>
</nav>

<!-- 📤 Modal Compartir -->
<div class="modal fade" id="modalCompartir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Compartir esta página</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Copia este enlace para compartir:</p>
                <input type="text" id="linkCompartir" class="form-control" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" readonly>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="copiarEnlace()">Copiar enlace</button>
            </div>
        </div>
    </div>
</div>

<!-- 🛒 Modal Carrito -->
<div id="carritoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1050;">
    <div style="background:#fff; width:400px; margin:10% auto; padding:20px; border-radius:10px; position:relative;">
        <h4>🛒 Tu Carrito</h4>
        <div id="contenidoCarrito"><p>No hay productos en el carrito.</p></div>
        <button onclick="cerrarCarrito()" class="btn btn-danger btn-sm" style="position:absolute; top:10px; right:10px;">X</button>
    </div>
</div>

<!-- 🧳 Listado de planes -->
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($paquetes as $paquete): ?>
            <div class="col">
                <div class="card h-100">
                    <!-- Imagen del plan desde BD -->
                    <img src="<?=$paquete['imagenes']?>" class="card-img-top" alt="<?=$paquete['nom_planes']?>" style="height:180px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?=$paquete['nom_planes']?></h5>
                        <p class="text-muted mb-1">Inicio: <?=$paquete['f_inicio']?></p>
                        <p class="text-muted">Fin: <?=$paquete['f_fin']?></p>
                        <h5 class="text-success fw-bold">$<?=$paquete['precio']?></h5>

                        <!-- ⭐ Estrellas seleccionables -->
                        <div class="mb-2">
                            <span class="estrella" onclick="seleccionarEstrella(this)">★</span>
                            <span class="estrella" onclick="seleccionarEstrella(this)">★</span>
                            <span class="estrella" onclick="seleccionarEstrella(this)">★</span>
                            <span class="estrella" onclick="seleccionarEstrella(this)">★</span>
                            <span class="estrella" onclick="seleccionarEstrella(this)">★</span>
                        </div>

                        <!-- Botones Descripción y Comprar -->
                        <button class="btn btn-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#descripcionModal<?=$paquete['id_planes']?>">Descripción</button>

                        <div class="input-group">
                            <input type="number" min="1" value="1" id="cantidad<?=$paquete['id_planes']?>" class="form-control text-center">
                            <button class="btn btn-success w-50" onclick="agregarAlCarrito('<?=$paquete['nom_planes']?>', <?=$paquete['precio']?>, <?=$paquete['id_planes']?>)">Agregar 🛒</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de descripción -->
            <div class="modal fade" id="descripcionModal<?=$paquete['id_planes']?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header"><h5><?=$paquete['nom_planes']?></h5></div>
                        <div class="modal-body">
                            <p><?=$paquete['descripcion']?></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- 📜 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
let carrito = [];

// 🟢 Abrir y cerrar el carrito
function abrirCarrito() {
    document.getElementById('carritoModal').style.display = 'block';
    mostrarCarrito();
}
function cerrarCarrito() {
    document.getElementById('carritoModal').style.display = 'none';
}

// 🛒 Agregar producto al carrito
function agregarAlCarrito(nombre, precio, id) {
    const cantidad = document.getElementById('cantidad' + id).value;
    carrito.push({nombre, precio, cantidad});
    mostrarCarrito();
    alert('Producto agregado al carrito');
}

// Mostrar contenido del carrito
function mostrarCarrito() {
    const cont = document.getElementById('contenidoCarrito');
    if (carrito.length === 0) {
        cont.innerHTML = '<p>No hay productos en el carrito.</p>';
    } else {
        let html = '<ul class="list-group">';
        carrito.forEach((p, i) => {
            html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                ${p.nombre} x${p.cantidad}
                <span>$${(p.precio * p.cantidad).toFixed(2)}</span>
            </li>`;
        });
        html += '</ul>';
        cont.innerHTML = html;
    }
}

// 📋 Copiar enlace del modal compartir
function copiarEnlace() {
    const input = document.getElementById('linkCompartir');
    input.select();
    document.execCommand('copy');
    alert('Enlace copiado al portapapeles');
}

// ⭐ Seleccionar estrellas
function seleccionarEstrella(elemento) {
    const estrellas = elemento.parentNode.querySelectorAll('.estrella');
    let activa = false;
    estrellas.forEach(estrella => {
        if (estrella === elemento) activa = true;
        estrella.classList.toggle('seleccionada', activa);
    });
}
</script>
</body>
</html>