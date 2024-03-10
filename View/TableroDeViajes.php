<?php

require_once __DIR__ . '/../controller/ViajeController.php';

// Raanudamos la sesión del usuario
    session_start();
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
    <title>Tablero de Viajes - Mytra</title>
</head>
<body>
    <h1>Tablero de Viajes</h1>
    <h1>Bienvenido  a tu Tablero de Viajes en Mytra</h1>   

    <!-- Mostrar mensajes de éxito/error -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?php echo $_SESSION['mensaje']; ?></p>
        <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
    <?php endif; ?>

   <!-- Formulario para crear un nuevo viaje -->
<h2>Crear un nuevo viaje</h2>
<form method="POST" action="../Controller/crearViaje.php">
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

<!-- Mostrar los viajes -->
<h2>Mis Viajes</h2>
<?php if(!empty($viajes)): ?>
    <ul>
        <?php foreach ($viajes as $viaje): ?>
            <li>
                <?php echo htmlspecialchars($viaje['nombre_viaje']);?> -
                Desde: <?php echo htmlspecialchars($viaje['fecha_inicio']); ?>, 
                Hasta: <?php echo htmlspecialchars($viaje['fecha_fin']); ?>, 
                Presupuesto: <?php echo htmlspecialchars($viaje['presupuesto_total']); ?> 
             </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No tienes viajes creados</p>
<?php endif; ?>

    
    <!-- Enlaces para cerrar sesión -->

    <a href="../index.php?cerrarSesion=true">Cerrar Sesión</a>
    <a href="./MiPerfil.php">Mi Perfil</a>
   
</body>
</html>