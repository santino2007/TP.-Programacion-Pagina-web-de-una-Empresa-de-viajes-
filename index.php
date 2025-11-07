<?php
require_once 'conexiones.php';
$paquetes = $conexion->query("SELECT * FROM planes WHERE planes.estado = 'activo';");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Emprender</title>
</head>



<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tour Emprende</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Compartir</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">comfiguracion</a></li>
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li>
                                <hr class="dropdown-divider" href="#">
                            </li>
                            <li><a class="dropdown-item" href="#">acitente</a></li>
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                    </li>
                </ul>

                <!-- Botón para Iniciar seccion -->
                <div>
                    <button onclick="iniciarSesion()" type="button"
                        class="btn btn-primary fw-bold rounded-pill shadow-sm px-4 py-2"
                        style="padding:10px 20px; background: linear-gradient(90deg,rgb(84, 135, 244),rgb(84, 244, 140)); border: none; color: white; transition: all 0.3s ease;">
                        Iniciar sección
                    </button>
                </div>
                <div id="iniciarSesion">

                </div>

                <!-- Botón para abrir el carrito -->
                <button onclick="abrirCarrito()" class="btn btn-outline-success"
                    style="padding:10px 20px; cursor:pointer;">
                    🛒 Ver Carrito
                </button>

                <!-- Modal del carrito -->
                <div id="carritoModal" style="
    display:none; 
    position:fixed; 
    top:0; left:0; 
    width:100%; height:100%; 
    background:rgba(0,0,0,0.6); 
    z-index:1050;
">
                    <div style="
    background:#fff; 
    width:400px; 
    margin:10% auto; 
    padding:20px; 
    border-radius:10px; 
    position:relative;
">
                        <h2>🛒 Tu Carrito</h2>
                        <div id="contenidoCarrito">
                            <!-- Aquí se cargarán los productos -->
                            <p>No hay productos en el carrito.</p>
                        </div>

                        <!-- Botón cerrar -->
                        <button onclick="cerrarCarrito()" style="
        position:absolute;
        top:10px;
        right:10px;
        background:red;
        color:#fff;
        border:none;
        padding:5px 10px;
        cursor:pointer;
        border-radius:5px;
    ">X</button>
                    </div>
                </div>

                <script>
                    function abrirCarrito() {
                        document.getElementById('carritoModal').style.display = 'block';
                    }
                    function cerrarCarrito() {
                        document.getElementById('carritoModal').style.display = 'none';
                    }
                </script>

    </nav>



    <div class="container mt-3">

        <div class="row row-cols-2 row-cols-md-3 g-4">
            <?php
            if ($paquetes->num_rows > 0)
                foreach ($paquetes as $paquete) {
                    ?>

                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="https://picsum.photos/250/120?random=7" class="card-img-top" alt="españa">
                            <div class="card-body">
                                <h5 class="card-title"><?= $paquete['nom_planes'] ?> </h5>
                                <!--fecha-->
                                <p>fecha de inicio:<?= $paquete['f_inicio'] ?></p>
                                <p>fecha de fin:<?= $paquete['f_fin'] ?></p>
                                <p></p>
                                <span class="badge bg-light text-dark" ++>⭐⭐⭐⭐</span>
                                <!--motrar precio-->
                                <div class="mt-3">
                                    <h3>Precio:<?= $paquete['precio'] ?></h3>
                                </div>
                                <div class="card-footer bg-transpa border-0 mt-3">
                                    <a href="index2.php?id<?= $paquete['id_planes'] ?>"
                                        class="btn btn-success w-100 fw-bold rounded-pill">
                                        descripcion
                                    </a>
                                </div>
                                <div class="card-footer bg-transpa border-0 mt-3">
                                    <a href="index3.php?id<?= $paquete['id_planes'] ?>"
                                        class="btn btn-success w-100 fw-bold rounded-pill">
                                        comprar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>