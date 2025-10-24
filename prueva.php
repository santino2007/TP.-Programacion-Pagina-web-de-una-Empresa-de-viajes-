<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Seguir ubicación del usuario</title>
</head>
<body>
  <h2>Tu ubicación:</h2>
  <p id="ubicacion">Buscando...</p>

  <script>
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(
        (pos) => {
          const lat = pos.coords.latitude;
          const lon = pos.coords.longitude;
          document.getElementById("ubicacion").textContent =
            `Latitud: ${lat.toFixed(5)}, Longitud: ${lon.toFixed(5)}`;
        },
        (error) => {
          document.getElementById("ubicacion").textContent = "No se pudo obtener la ubicación.";
        }
      );
    } else {
      document.getElementById("ubicacion").textContent = "Tu navegador no soporta geolocalización.";
    }
  </script>
</body>
</html>

