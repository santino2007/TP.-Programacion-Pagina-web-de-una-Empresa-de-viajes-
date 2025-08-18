<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Emprende</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Tour Emprende</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>

        </li>
        <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
    </ul>
    <button type="button" class="btn btn-primary position-relative">
    carito
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      
    <span class="visually-hidden">unread messages</span>
    </span>
    </button>
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="buscar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">buscar</button>
    </form>
    </div>
</div>
</nav>

<div class="btn-group-vertical">
  <button type="button" class="btn btn-dark">peso</button>
  <button type="button" class="btn btn-dark">dolar</button>
  <button type="button" class="btn btn-dark">euro</button>
</div>


<div class="container mt-3">

  <div class="row row-cols-2 row-cols-md-3 g-4">
    <?php
    $destinos = "Barcelona - Disfruta de las playas, la Sagrada Familia y la mejor comida mediterránea.|París - Vive el romance en la ciudad de la luz y visita la Torre Eiffel.|Roma - Recorre el Coliseo y disfruta de la auténtica pasta italiana.|Cancún - Relájate en sus playas paradisíacas y explora las ruinas mayas.|Bariloche - Descubre la belleza de la Patagonia y sus lagos cristalinos.|Tokio - Vive la mezcla perfecta entre tradición y tecnología futurista.|El Cairo - Explora las pirámides y la historia milenaria del Nilo.|Río de Janeiro - Baila samba en el carnaval y disfruta de la playa de Copacabana.|Atenas - Recorre la Acrópolis y siente la cuna de la civilización.|Nueva York - Conquista la Gran Manzana y vive la ciudad que nunca duerme.";
    // Convertir en array
    $listaDestinos = explode("|", $destinos);
    
    // Seleccionar un destino aleatorio
    $destinoAleatorio = $listaDestinos[array_rand($listaDestinos)];
    
    for($i = 0; $i < 6; $i++) {?>
    <div class="col">
      <div class="card" style="width: 18rem;">
        <img src="https://picsum.photos/250/120?random=7" class="card-img-top" alt="españa">
        <div class="card-body">
          <h5 class="card-title">Benidorm</h5>
          <?php echo "<p> $destinoAleatorio </p>";?>
          <p>180.550,99</p>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              comprar
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <?php echo "<p> $destinoAleatorio </p>";?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
                    <button type="button" class="btn btn-primary">comprar</button>
                  </div>
                </div>
              </div>
            </div>
          <span class="badge bg-light text-dark"++>⭐⭐⭐⭐</span>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="container mt-3">
  <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://picsum.photos/250/120?random=1" class="d-block w-50" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/250/120?random=2" class="d-block w-50" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/250/120?random=3" class="d-block w-50" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<div>
  <div>
    <p>Somos una empresa de viajes dedicada a convertir cada destino en una experiencia inolvidable. Nos especializamos en la organización de viajes personalizados, excursiones, paquetes turísticos y asesoramiento integral para todo tipo de viajeros. Nuestro equipo trabaja con compromiso, pasión y atención al detalle, garantizando seguridad, confianza y acompañamiento en cada etapa del viaje. Ya sea que busques aventura, relax, cultura o naturaleza, estamos para ayudarte a hacer realidad ese viaje que tanto soñás.</p>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

