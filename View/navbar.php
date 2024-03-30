<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--BOOTSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!--CSS para personalizar el navbar-->
   <link rel="stylesheet" href="../assets/css/navbar.css">
    <title>Navbar</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-body-tertiary">
  <div class="container-fluid">
    
    <button class="navbar-toggler order-2 order-md-1" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3 order-md-2" id="navbar-left">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./TableroDeViajes.php">Tablero de viajes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./sobreMytra.php">Sobre MYTRA</a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand order-1 order-md-3" href="#">MYTRA  <img src="../assets/img/logo1.png" alt="logo-mytra"> Travel Planificator</a>
    <div class="collapse navbar-collapse order-4 order-md-4" id="navbarNav-right">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="./MiPerfil.php">Mi perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php?cerrarSesion=true">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!--BOOTSTRAP JS-->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>