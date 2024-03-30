<?php

require_once __DIR__ . '/../controller/ViajeController.php';

// Raanudamos la sesión del usuario
    session_start();

    
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }

    $viajeController = new ViajeController();
    $idUsuario = $_SESSION['id_usuario'];

    //Obtenemos los viajes del usuario
    $viajes = $viajeController->obtenerViajesPorUsuarioController($idUsuario);

    
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/btn.css">
    <link rel="stylesheet" href="../assets/css/tablero-viajes.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Tablero de Viajes - Mytra</title>
</head>
<body>

    <?php include './navbar.php'; ?>
    
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar - Formulario para crear un nuevo viaje -->
        <div class="col-sm-3 col-md-3 col-lg-2 g-5 mt-0 sidebar">
            <div class="text-center mt-2 mb-4">
                <h2 class="lead mt-4 mb-3">Bienvenido  a tu Tablero de Viajes en Mytra</h2>   
            </div>
            <div class="mb-1">
            <h2 class=" mb-4">Crear un nuevo viaje</h2>
            </div>
            <form method="POST" action="../Controller/CrearViaje.php">
               <div class="mb-1">
                    <label class="form-label" for="nombre_viaje">Nombre del Viaje:</label>
                    <input class="form-control" type="text" name="nombre_viaje" id="nombre_viaje" required><br><br>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="fecha_inicio">Fecha de Inicio:</label>
                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" required><br><br>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="fecha_fin">Fecha de Fin:</label>
                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required><br><br>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="presupuesto_total">Presupuesto Total:</label>
                    <input class="form-control" type="number" name="presupuesto_total" id="presupuesto_total" step="0.01" required><br><br>
                </div>

                <div class="text-center">
                    <input class="btn btn-primary crear_viaje mb-4" type="submit" name="crear_viaje" value="Crear Viaje">
                </div>
            </form>
        </div>

     
<!-- Contenido principal - Mis Viajes -->
    <div class="col-sm-9 col-md-9 col-lg-10" style="background: #ececec;">
        <!-- Mostrar mensajes de éxito/error -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div id="alert-box" class="alert alert-info text-center">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
        <?php endif; ?>

       
        <div class="text-center mb-0 mt-2">
            <h2 class="display-4 ">Mis Viajes</h2>
        </div>
        <!--Fila para las tarjetas de viaje-->
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 ml-3 g-3">
            <?php if(!empty($viajes)): ?>
                <?php foreach ($viajes as $viaje): 
                    $fechaInicio = date('d/m/Y', strtotime($viaje['fecha_inicio']));
                    $fechaFin = date('d/m/Y', strtotime($viaje['fecha_fin']));
                
                ?>
                    <!--Columna individual para cada tarjeta de viaje-->
                    <div class="col-12 col-sm-11 col-md-11 col-lg-6 mb-0 g-4 mt-4 ml-3 viaje" >
                        <div class="card text-center d-flex flex-column flex-lg-row">
                            <div class="viaje-info text-center w-100 w-lg-50" onclick="window.location.href='gestionViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>';">
                                <h3 class="text-center mb-3"><?php echo htmlspecialchars($viaje['nombre_viaje']);?></h3>
                                <p><strong>Desde:</strong> <?php echo $fechaInicio ?></p> 
                                <p><strong>Hasta:</strong> <?php echo $fechaFin; ?></p>
                                <p><strong>Presupuesto:</strong> <?php echo htmlspecialchars($viaje['presupuesto_total']); ?>€</p> 
                            </div>
                            <div class="viaje-imagen mt-3 mt-lg-0 w-100 w-lg-50 d-flex flex-column align-items-center align-items-lg-end justify-content-center justify-content-lg-center">
                                <!--Si hay una imágen, mostrarla-->
                                <?php if(!empty($viaje['ruta_imagen'])): ?>
                                    <img src="../assets/uploads/<?php echo htmlspecialchars($viaje['ruta_imagen']);?>" class="rounded img-fluid" alt="Imagen del viaje">
                                <?php endif; ?>
                                
                                <!--Formulario para cargar imagen-->
                                <div class="viaje-imagen-form d-flex flex-column align-items-center justify-content-center w-100 w-lg-50 mt-3 mt-lg-0">
                                    <form method="POST" action="../Controller/ActualizarImagenViaje.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id_viaje" value="<?php echo $viaje['id_viaje']; ?>">
                                        <label for="imagen_viaje_<?php echo $viaje['id_viaje'];?>">Cargar imágen </label>
                                        <input type="file" name="imagen_viaje" id="imagen_viaje_<?php echo $viaje['id_viaje'];?>" accept="image/*" onchange="this.form.submit()"><br><br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tienes viajes creados</p>
            <?php endif; ?>
        </div>
        </div>
    </div>
</div>
</div>



    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--Enlace con JavaScript-->
    <script src="../assets/js/tablero-viajes.js"></script>
</body>
</html>