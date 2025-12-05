<?php
    session_start();
        require_once 'conexiones.php';
        $paquetes = $conexion->query("SELECT * FROM planes WHERE estado = 'activo';");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Emprender</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
        

        .navbar {
            background:rgb(173, 97, 74);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 2px 6px rgb(235, 179, 142);
            background-color:rgb(235, 179, 142);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .btn-success {
            background-color:rgb(0, 0, 0);
            border: none;
        }

        .btn-success:hover {
            background-color:rgb(252, 126, 94);
        }

        /* Estilo de estrellas */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 1.5rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #f5c518;
        }

        /* Modal del carrito */
        #carritoModal {
            display:none;
            position:fixed;
            top:0; left:0;
            width:100%; height:100%;
            background:rgba(0,0,0,0.5);
            z-index:1050;
            justify-content:center;
            align-items:center;
        }

        #carritoContenido {
            background:white;
            padding:20px;
            border-radius:10px;
            width:90%;
            max-width:400px;
        }

        .btn-vaciar {
            background-color:rgb(255, 0, 0);
            border: none;
        }

        .btn-vaciar:hover {
            background-color:rgb(255, 2, 2);
        }
    </style>
</head>
<body>




<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Tour Emprende</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>

                <!-- Botón Compartir -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#compartirModal">Compartir</a>
                </li>

                <!-- Dropdown Configuración y Asistente -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Menú</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Asistente</a></li>
                    </ul>
                </li>
            </ul>
            <div><!-- Área de inision de usuarios -->
                <?php
                if ($_SESSION['gmail']){
                    echo 'HOLA'. $usuarios['gmail'];
                    echo '<a href="logout.php">CERRAR SESIÓN</a>';
                } else{
                    echo '<a href="login.php">INICIAR SESIÓN</a>';
                }
                ?>
            </div>
            <!-- Botón Carrito -->
            <button onclick="abrirCarrito()" class="btn btn-outline-success">🛒 Carrito</button>
        </div>
    </div>
</nav>

<!-- Modal Compartir -->
<div class="modal fade" id="compartirModal" tabindex="-1" aria-labelledby="compartirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compartir este sitio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Copia el enlace para compartir:</p>
                <input type="text" id="urlCompartir" class="form-control text-center" readonly value="<?='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>">
                <button class="btn btn-primary mt-2" onclick="copiarEnlace()">📋 Copiar enlace</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Descripción -->
<div class="modal fade" id="descripcionModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloDescripcion"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="contenidoDescripcion"></div>
    </div>
  </div>
</div>

<!-- Carrito Modal -->
<div id="carritoModal">
    <div id="carritoContenido">
        <h5 class="text-center">🛍 Tu Carrito</h5>
        <div id="productosCarrito" class="mt-3">No hay productos agregados.</div>
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-vaciar" onclick="vaciarCarrito()">🗑️ Vaciar carrito</button>
            <button class="btn btn-danger" onclick="cerrarCarrito()">Cerrar</button>
        </div>
    </div>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($paquetes as $paquete): ?>
            <div class="col">
                <div class="card h-100 text-center">
                    <!-- Imagen desde la base -->
                    <img src="<?= $paquete['imagen'] ?? 'https://via.placeholder.com/250x120'; ?>" class="card-img-top" alt="<?=$paquete['nom_planes']?>">

                    <div class="card-body">
                        <h5 class="card-title"><?=$paquete['nom_planes']?></h5>
                        <p>Inicio: <?=$paquete['f_inicio']?></p>
                        <p>Fin: <?=$paquete['f_fin']?></p>
                        <p class="fw-bold text-success">💵 $<?=$paquete['precio']?></p>

                        <!-- Estrellas seleccionables -->
                        <div class="rating">
                            <input type="radio" id="star5-<?=$paquete['id_planes']?>" name="rating-<?=$paquete['id_planes']?>" value="5"><label for="star5-<?=$paquete['id_planes']?>">★</label>
                            <input type="radio" id="star4-<?=$paquete['id_planes']?>" name="rating-<?=$paquete['id_planes']?>" value="4"><label for="star4-<?=$paquete['id_planes']?>">★</label>
                            <input type="radio" id="star3-<?=$paquete['id_planes']?>" name="rating-<?=$paquete['id_planes']?>" value="3"><label for="star3-<?=$paquete['id_planes']?>">★</label>
                            <input type="radio" id="star2-<?=$paquete['id_planes']?>" name="rating-<?=$paquete['id_planes']?>" value="2"><label for="star2-<?=$paquete['id_planes']?>">★</label>
                            <input type="radio" id="star1-<?=$paquete['id_planes']?>" name="rating-<?=$paquete['id_planes']?>" value="1"><label for="star1-<?=$paquete['id_planes']?>">★</label>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex flex-column align-items-center mt-3">
                            <button class="btn btn-info text-white mb-2" onclick="mostrarDescripcion('<?=$paquete['nom_planes']?>', '<?=$paquete['detalles_planes'] ?? 'Sin descripción disponible.'?>')">
                                📄 Descripción
                            </button>
                            <div class="d-flex">
                                <input type="number" id="cantidad-<?=$paquete['id_planes']?>" min="1" max="10" value="1" class="form-control me-2" style="width:70px;">
                                <button class="btn btn-success" onclick="agregarCarrito('<?=$paquete['nom_planes']?>', <?=$paquete['precio']?>, <?=$paquete['id_planes']?>)">🛒 Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap y scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function copiarEnlace() {
    const input = document.getElementById('urlCompartir');
    input.select();
    document.execCommand('copy');
    alert('Enlace copiado al portapapeles.');
}

function mostrarDescripcion(nombre, descripcion) {
    document.getElementById('tituloDescripcion').textContent = nombre;
    document.getElementById('contenidoDescripcion').textContent = descripcion;
    new bootstrap.Modal(document.getElementById('descripcionModal')).show();
}

let carrito = [];

function agregarCarrito(nombre, precio, id) {
    const cantidad = parseInt(document.getElementById(`cantidad-${id}`).value);
    carrito.push({id, nombre, precio, cantidad});
    mostrarCarrito();
}

function eliminarDelCarrito(id) {
    carrito = carrito.filter(p => p.id !== id);
    mostrarCarrito();
}

function vaciarCarrito() {
    carrito = [];
    mostrarCarrito();
}

function mostrarCarrito() {
    const contenedor = document.getElementById('productosCarrito');
    if (carrito.length === 0) {
        contenedor.innerHTML = "No hay productos agregados.";
        return;
    }
    let html = "<ul class='list-group'>";
    carrito.forEach(p => {
        html += `<li class='list-group-item d-flex justify-content-between align-items-center'>
                    <div>${p.nombre} x${p.cantidad}</div>
                    <div>
                        <span class='me-2'>$${p.precio * p.cantidad}</span>
                        <button class='btn btn-sm btn-danger' onclick='eliminarDelCarrito(${p.id})'>❌</button>
                    </div>
                </li>`;
    });
    html += "</ul>";
    contenedor.innerHTML = html;
}

function abrirCarrito() {
    document.getElementById('carritoModal').style.display = 'flex';
}

function cerrarCarrito() {
    document.getElementById('carritoModal').style.display = 'none';
}
</script>

</body>
</html>
