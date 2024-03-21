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
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Gestión de Viajes - Mytra</title>
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

    <!--Botón eliminar viaje-->
    <form method="POST" action="../Controller/EliminarViaje.php" onsubmit="return confirm('¿Estás seguro dequerer eliminar este viaje?');">
        <input type="hidden" name="id_viaje" value="<?= $viaje['id_viaje']?>">
        <button type="submit" class="btn-eliminar" title="Eliminar">
        <i class="fas fa-trash-alt"></i>
        </button>
    </form>
    <!-- Botón para mostrar el formulario de editar viaje -->
    <button id="btnEditarViaje" class="btn-editar">Editar Viaje</button>

        <!-- Formulario de edición de viaje, inicialmente oculto -->
        <div id="formularioEditarViaje" style="display:none;">
            <form method="POST" action="../Controller/ActualizarViaje.php"> <!-- Actualiza esta ruta según tu estructura -->
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
     <button id="btnAnadirDestino">Añadir Nuevo Destino</button><br><br>
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

    <!--Tarjetas de destinos-->
    <?php if (!empty($destinos)): ?>
        <div class="destinos-container">
            <?php foreach ($destinos as $destino): ?>
                <div class="destino-card">
                    <div class="destino" onclick="window.location.href='gestionActividades.php?id_destino=<?php echo $destino['id_destino']; ?>&id_viaje=<?=$idViaje?>';">
                        <h3 class="titulo-card"><?= htmlspecialchars($destino['nombre_destino'])?></h3>
                    </div>
                    <div class="card-content">
                        <div class="fecha-info">
                        <p>Desde: <?= htmlspecialchars($destino['fecha_inicio'])?></p>
                        <p>Hasta: <?= htmlspecialchars($destino['fecha_fin'])?></p>
                        </div>
                        <div class="destino-card-buttons">
                            <button class="btn-editar" onclick="toggleEditarDestinoForm('<?= $destino['id_destino'] ?>')">Editar</button>
                            <!--Botón eliminar destino-->
                            <form method="POST" action="../Controller/EliminarDestino.php" onsubmit="return confirm('¿Estás seguro dequerer eliminar este destino?');">
                                <input type="hidden" name="id_destino" value="<?= $destino['id_destino']?>">
                                <input type="hidden" name="id_viaje" value="<?= $destino['id_viaje']?>">
                                <button type="submit" class="btn-eliminar" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--Formulario de edición de destino oculto -->
                    <div id="formularioEditarDestino-<?= $destino['id_destino'] ?>" style="display: none;">
                        <form method="POST" action="../Controller/ActualizarDestino.php">
                            <input type="hidden" name="id_viaje" value="<?php echo htmlspecialchars($viaje['id_viaje']); ?>">
                            <input type="hidden" name="id_destino" value="<?= $destino['id_destino'] ?>">
                            <label for="nombre_destino">Nombre del Destino:</label>
                            <input type="text" id="nombre_destino" name="nombre_destino" value="<?= $destino['nombre_destino'] ?>" required><br><br>
                            <label for="fecha_inicio_destino">Fecha de Inicio:</label>
                            <input type="date" id="fecha_inicio_destino" name="fecha_inicio" value="<?= $destino['fecha_inicio'] ?>" required><br><br>
                            <label for="fecha_fin_destino">Fecha de Fin:</label>
                            <input type="date" id="fecha_fin_destino" name="fecha_fin" value="<?= $destino['fecha_fin'] ?>" required><br><br>
                            <input type="submit" value="Guardar Cambios">
                        </form>
                    </div>
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
    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>