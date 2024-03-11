<?php

require_once __DIR__ . '/../controller/ViajeController.php';
require_once __DIR__ . '/../controller/DestinoController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$viajeController = new ViajeController();
$destinoController = new DestinoController();

//Operador de fusión null, se asignará como valor null si $_GET['id_viaje'] no está definido
$idViaje = isset($_GET['id_viaje']) ? (int) $_GET['id_viaje'] : null;
 
if ($idViaje) {
    $viaje = $viajeController->obtenerViajePorIdController($idViaje);
    $destinos = $destinoController->obtenerDestinosPorViajeController($idViaje);

   
} else {
    $_SESSION['mensaje'] = "No se ha especificado el viaje.";
    // Redirigir si no se proporciona id_viaje
    header("Location: ./TableroDeViajes.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Gestión de Viaje - Mytra</title>
</head>
<body>
    <?php if (isset($_SESSION['mensaje'])) {
        echo "<p>" . $_SESSION['mensaje'] . "</p>";
        unset($_SESSION['mensaje']); // Borra el mensaje después de mostrarlo
    }
    ?>
    
    <h1>Gestión de Viaje: <?php echo htmlspecialchars($viaje['nombre_viaje']); ?></h1>
    
    <!--Mostramos la información del viaje actual-->
    <div class="informacion-viaje">
        <h2>Información del Viaje</h2>
        <p><strong>Fecha de Inicio:</strong> <?php echo htmlspecialchars($viaje['fecha_inicio']); ?></p>
        <p><strong>Fecha de Fin:</strong> <?php echo htmlspecialchars($viaje['fecha_fin']); ?></p>
        <p><strong>Presupuesto Total:</strong> <?php echo htmlspecialchars($viaje['presupuesto_total']); ?>€</p>
    </div>

    <div>
        <a href="../Controller/EliminarViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>" onclick="return confirm('¿Estás seguro de querer eliminar este viaje?');">Eliminar este viaje</a>
    </div>
    <br>
    <!-- Botón para mostrar el formulario de editar viaje -->
    <button id="btnEditarViaje">Editar Viaje</button>

        <!-- Formulario de edición de viaje, inicialmente oculto -->
        <div id="formularioEditarViaje" style="display:none;">
            <form method="POST" action="../Controller/ctualizarViaje.php"> <!-- Actualiza esta ruta según tu estructura -->
                <input type="hidden" name="id_viaje" value="<?php echo htmlspecialchars($viaje['id_viaje']); ?>"> <!--Campo invisible para el usuario-->

                <label for="nombre_viaje">Nombre del Viaje:</label>
                <input type="text" id="nombre_viaje" name="nombre_viaje" value="<?php echo htmlspecialchars($viaje['nombre_viaje']); ?>" required><br><br>

                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($viaje['fecha_inicio']); ?>" required><br><br>

                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($viaje['fecha_fin']); ?>" required><br><br>

                <label for="presupuesto_total">Presupuesto Total:</label>
                <input type="number" id="presupuesto_total" name="presupuesto_total" value="<?php echo htmlspecialchars($viaje['presupuesto_total']); ?>" required step="0.01"><br><br>

                <input type="submit" value="Actualizar Viaje">
            </form>
        </div>
    <br><br><hr>

    <h2>Destinos</h2>

     <!-- Botón para mostrar el formulario de añadir nuevo destino -->
     <button id="btnAnadirDestino">Añadir Nuevo Destino</button>
    <!-- Formulario para añadir nuevo destino, inicialmente oculto -->
    <div id="formularioAnadirDestino" style="display:none;">
        <form method="POST" action="../Controller/CrearDestino.php"> <!-- Actualiza esta ruta según tu estructura -->
            <input type="hidden" name="id_viaje" value="<?php echo $idViaje; ?>"> <!--Campo invisible para el usuario-->

            <label for="nombre_destino">Nombre del Destino:</label>
            <input type="text" id="nombre_destino" name="nombre_destino" required><br><br>

            <label for="fecha_inicio_destino">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio_destino" name="fecha_inicio" required><br><br>

            <label for="fecha_fin_destino">Fecha de Fin:</label>
            <input type="date" id="fecha_fin_destino" name="fecha_fin" required><br><br>

            <input type="submit" value="Añadir Destino">
        </form>
    </div>

    <?php if (!empty($destinos)): ?>
        <div class="destinos-container">
            <?php foreach ($destinos as $destino): ?>
                <div class="destino-card" onclick="window.location.href='gestionDestino.php?id_destino=<?= $destino['id_destino']?>';">
                    <h3><?= htmlspecialchars($destino['nombre_destino'])?></h3>
                    <p>Desde: <?= htmlspecialchars($destino['fecha_inicio'])?></p>
                    <p>Desde: <?= htmlspecialchars($destino['fecha_fin'])?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay destinos para este viaje</p>
    <?php endif; ?>

    <div>
        <a href="./TableroDeViajes.php">Volver al Tablero de Viajes</a>
    </div>

   

    

   

    <!--Enlace con JavaScript-->
    <script src="../assets/js/gestionViaje.js"></script>
</body>
</html>