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
    <link rel="stylesheet" href="../assets/css/style.css">
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Tablero de Viajes - Mytra</title>
</head>
<body>
    
    <h1>Tablero de Viajes</h1>
    <h2>Bienvenido  a tu Tablero de Viajes en Mytra</h2>   

    <!-- Mostrar mensajes de éxito/error -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?php echo $_SESSION['mensaje']; ?></p>
        <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
    <?php endif; ?>

   <!-- Formulario para crear un nuevo viaje -->
<div class="container">
    <h2>Crear un nuevo viaje</h2>
    <form method="POST" action="../Controller/CrearViaje.php">
        <label for="nombre_viaje">Nombre del Viaje:</label>
        <input type="text" name="nombre_viaje" id="nombre_viaje" required><br><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required><br><br>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required><br><br>

        <label for="presupuesto_total">Presupuesto Total:</label>
        <input type="number" name="presupuesto_total" id="presupuesto_total" step="0.01" required><br><br>

        <input type="submit" name="crear_viaje" value="Crear Viaje">
    </form>
</div>
<!-- Mostrar los viajes -->
<div class="container text-center">
<h2>Mis Viajes</h2>
<?php if(!empty($viajes)): ?>
    <?php foreach ($viajes as $viaje): ?>
        <div class="viaje" >
                <div class="viaje-info" onclick="window.location.href='gestionViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>';">
                    <h3><?php echo htmlspecialchars($viaje['nombre_viaje']);?></h3>
                    <p>Desde: <?php echo htmlspecialchars($viaje['fecha_inicio']); ?></p> 
                    <p>Hasta: <?php echo htmlspecialchars($viaje['fecha_fin']); ?></p>
                    <p>Presupuesto: <?php echo htmlspecialchars($viaje['presupuesto_total']); ?>€</p> 
                </div>
                <div class="viaje-imagen">
                    <!--Si hay una imágen, mostrarla-->
                    <?php if(!empty($viaje['ruta_imagen'])): ?>
                        <img src="../assets/uploads/<?php echo htmlspecialchars($viaje['ruta_imagen']);?>" alt="Imagen del viaje">
                    <?php endif; ?>
                    
                     <!--Formulario para cargar imagen-->
                    <div class="viaje-imagen-form">
                    <form method="POST" action="../Controller/ActualizarImagenViaje.php" enctype="multipart/form-data">
                        <input type="hidden" name="id_viaje" value="<?php echo $viaje['id_viaje']; ?>">
                        <label for="imagen_viaje_<?php echo $viaje['id_viaje'];?>">Subir una foto </label>
                        <input type="file" name="imagen_viaje" id="imagen_viaje_<?php echo $viaje['id_viaje'];?>" accept="image/*" onchange="this.form.submit()"><br><br>
                        <!-- <input type="submit" value="Cambiar imagen"> -->
                    </form>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No tienes viajes creados</p>
<?php endif; ?>
</div>
    
    <!-- Enlaces para cerrar sesión -->

    <a href="../index.php?cerrarSesion=true">Cerrar Sesión</a>
    <a href="./MiPerfil.php">Mi Perfil</a>

    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>