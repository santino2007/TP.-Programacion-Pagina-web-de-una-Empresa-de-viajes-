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
/* ====== Estilos generales ====== */
body { background-color: #e6f2ff; padding-top: 80px; }
.card { transition: transform .18s ease, box-shadow .18s ease; }
.card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
.quantity-input { width: 80px; }
.modal-img { max-height: 220px; object-fit: cover; width:100%; border-radius:6px; }

/* ====== Estrellas ====== */
.stars {
    display: flex;
    gap: 4px;
    cursor: pointer;
}
.star {
    font-size: 1.3rem;
    color: #ddd;
    transition: color 0.2s;
}
.star.selected,
.star:hover,
.star:hover ~ .star {
    color: #ffc107;
}
</style>
</head>
<body>

<!-- ====== Navbar ====== -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Tour Emprende</a>
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
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Asistente</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Botones sesión y carrito -->
            <div class="d-flex align-items-center gap-2">
                <button onclick="iniciarSesion()" type="button" class="btn btn-primary fw-bold rounded-pill shadow-sm px-4 py-2">
                    Iniciar sesión
                </button>

                <button type="button" class="btn btn-outline-success position-relative" data-bs-toggle="modal" data-bs-target="#cartModal" id="openCartBtn">
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
                <h5 class="modal-title fw-bold" id="shareModalLabel">Compartir enlace</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <label for="shareUrl" class="form-label small">Copia este enlace y compártelo</label>
                <div class="input-group">
                    <input type="text" id="shareUrl" class="form-control" readonly>
                    <button class="btn btn-outline-secondary" id="copyShareBtn" type="button">Copiar</button>
                </div>
                <div id="copyFeedback" class="small text-success mt-2" style="display:none;">Enlace copiado ✅</div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Modal Descripción ====== -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="descriptionModalLabel">Descripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <img id="descriptionImage" src="" alt="Imagen" class="modal-img shadow-sm">
                    </div>
                    <div class="col-md-6">
                        <h4 id="descriptionTitle"></h4>
                        <p id="descriptionDates" class="mb-1"></p>
                        <h5 id="descriptionPrice" class="text-success"></h5>
                        <div id="descriptionText" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Modal Carrito ====== -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="cartModalLabel">🛒 Tu Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="cartContent"></div>
                <div id="cartEmpty" class="text-center text-muted">No hay productos en el carrito.</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Seguir comprando</button>
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
            <div class="card h-100">
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
                            <a href="index3.php?id=<?= urlencode($id) ?>" class="btn btn-success w-100 fw-bold rounded-pill">Comprar</a>
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
/* =====================================================
    FUNCIONALIDADES: Compartir | Descripción | Carrito | Estrellas
===================================================== */

/* ---------- Modal Compartir ---------- */
document.addEventListener('DOMContentLoaded', function() {
    const shareUrlInput = document.getElementById('shareUrl');
    const copyBtn = document.getElementById('copyShareBtn');
    const copyFeedback = document.getElementById('copyFeedback');
    var shareModal = document.getElementById('shareModal');
    shareModal.addEventListener('show.bs.modal', function () {
        shareUrlInput.value = window.location.href;
        copyFeedback.style.display = 'none';
    });
    copyBtn.addEventListener('click', function() {
        navigator.clipboard.writeText(shareUrlInput.value);
        copyFeedback.style.display = 'block';
    });
});

/* ---------- Modal Descripción ---------- */
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-description');
    if (!btn) return;
    document.getElementById('descriptionTitle').textContent = btn.dataset.nombre;
    document.getElementById('descriptionDates').textContent = btn.dataset.fechas;
    document.getElementById('descriptionPrice').textContent = "Precio: " + btn.dataset.precio;
    document.getElementById('descriptionText').innerHTML = btn.dataset.descripcion;
    document.getElementById('descriptionImage').src = btn.dataset.imagen;
});

/* ---------- Carrito ---------- */
(function(){
    const CART_KEY = 'mis_paquetes_carrito_v1';
    function getCart(){return JSON.parse(localStorage.getItem(CART_KEY)||'[]');}
    function setCart(c){localStorage.setItem(CART_KEY,JSON.stringify(c));renderCart();}
    function addToCart(it){const c=getCart();const ex=c.find(i=>i.id==it.id);if(ex)ex.qty+=it.qty;else c.push(it);setCart(c);}
    function removeFromCart(id){setCart(getCart().filter(i=>i.id!=id));}
    function updateQty(id,q){const c=getCart();const i=c.find(x=>x.id==id);if(i){i.qty=q;setCart(c);}}
    function renderCart(){
        const c=getCart(),cont=document.getElementById('cartContent'),emp=document.getElementById('cartEmpty'),badge=document.getElementById('cartCountBadge');
        let t=c.reduce((s,x)=>s+x.qty,0);badge.style.display=t>0?'inline-block':'none';badge.textContent=t;
        if(!c.length){cont.innerHTML='';emp.style.display='block';return;} emp.style.display='none';
        cont.innerHTML=c.map(i=>`<div class='list-group-item d-flex gap-2 align-items-center'>
            <img src='${i.imagen}' style='width:60px;height:50px;object-fit:cover;border-radius:5px;'>
            <div class='flex-grow-1'>
                <div class='d-flex justify-content-between'>
                    <strong>${i.nombre}</strong><span class='text-success small'>${i.precio}</span>
                </div>
                <div class='mt-1 d-flex gap-2 align-items-center'>
                    <input type='number' min='1' value='${i.qty}' data-id='${i.id}' class='form-control form-control-sm' style='width:70px;'>
                    <button class='btn btn-sm btn-outline-danger btn-remove' data-id='${i.id}'>Eliminar</button>
                </div>
            </div></div>`).join('');
    }
    document.addEventListener('click',function(e){
        const b=e.target.closest('.btn-add-cart');if(b){
            const id=b.dataset.id,n=b.dataset.nombre,p=b.dataset.precio,img=b.dataset.imagen;
            const qInput=document.getElementById('qty_'+id),q=qInput?Math.max(1,Number(qInput.value)):1;
            addToCart({id:id,nombre:n,precio:p,imagen:img,qty:q});
            new bootstrap.Modal(document.getElementById('cartModal')).show();
        }
        const r=e.target.closest('.btn-remove');if(r){removeFromCart(r.dataset.id);}
    });
    document.addEventListener('change',function(e){
        if(e.target.matches('input[type=number][data-id]')) updateQty(e.target.dataset.id,Number(e.target.value));
    });
    document.getElementById('checkoutBtn').addEventListener('click',()=>{
        const c=getCart();if(!c.length)return alert('El carrito está vacío');
        alert('Compra simulada con '+c.reduce((s,i)=>s+i.qty,0)+' artículos.');
        localStorage.removeItem(CART_KEY);renderCart();
        bootstrap.Modal.getInstance(document.getElementById('cartModal')).hide();
    });
    document.addEventListener('DOMContentLoaded',renderCart);
})();

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
