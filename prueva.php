<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tours Emprender</title>
<style>
  .modal { display: none; background: rgba(0,0,0,0.5); position: fixed; top:0; left:0; width:100%; height:100%; }
  .modal-dialog { margin: 10% auto; }
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Tour Emprende</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Compartir</a></li>
        </ul>
        
        <!-- Botón para abrir el carrito -->
        <button onclick="abrirCarrito()" class="btn btn-outline-primary">
            🛒 Ver Carrito (<span id="contador">0</span>)
        </button>
    </div>
</div>
</nav>

<div class="container mt-4">
    <h2>Productos</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Tour a la playa</h5>
                <p>Precio: $100</p>
                <button class="btn btn-success" onclick="agregarAlCarrito('Tour a la playa', 100)">Comprar</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Tour a la montaña</h5>
                <p>Precio: $150</p>
                <button class="btn btn-success" onclick="agregarAlCarrito('Tour a la montaña', 150)">Comprar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal del carrito -->
<div id="modalCarrito" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tu carrito</h5>
        <button type="button" class="btn-close" onclick="cerrarCarrito()"></button>
      </div>
      <div class="modal-body">
        <ul id="listaCarrito" class="list-group"></ul>
        <p class="mt-3"><strong>Total: $<span id="total">0</span></strong></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" onclick="vaciarCarrito()">🗑 Vaciar Carrito</button>
        <button class="btn btn-success" onclick="comprarTodo()">✅ Comprar Todo</button>
      </div>
    </div>
  </div>
</div>

<script>
  let carrito = [];

  function agregarAlCarrito(nombre, precio) {
    carrito.push({ nombre, precio });
    document.getElementById('contador').textContent = carrito.length;
    alert(nombre + " agregado al carrito!");
  }

  function abrirCarrito() {
    let lista = document.getElementById("listaCarrito");
    lista.innerHTML = "";
    let total = 0;

    carrito.forEach((item, index) => {
      let li = document.createElement("li");
      li.className = "list-group-item d-flex justify-content-between align-items-center";
      li.innerHTML = `
        ${item.nombre} - $${item.precio}
        <button class="btn btn-sm btn-danger" onclick="eliminarDelCarrito(${index})">❌</button>
      `;
      lista.appendChild(li);
      total += item.precio;
    });

    document.getElementById("total").textContent = total;
    document.getElementById("modalCarrito").style.display = "block";
  }

  function cerrarCarrito() {
    document.getElementById("modalCarrito").style.display = "none";
  }

  function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    document.getElementById('contador').textContent = carrito.length;
    abrirCarrito(); // refrescar lista
  }

  function vaciarCarrito() {
    carrito = [];
    document.getElementById('contador').textContent = 0;
    abrirCarrito();
  }

  function comprarTodo() {
    if (carrito.length === 0) {
      alert("Tu carrito está vacío 😅");
      return;
    }
    alert("✅ Compra realizada con éxito. ¡Gracias por tu pedido!");
    vaciarCarrito();
    cerrarCarrito();
  }
</script>

</body>
</html>

