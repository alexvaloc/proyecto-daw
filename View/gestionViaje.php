<?php

require_once __DIR__ . '/../controller/ViajeController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$viajeController = new ViajeController();

//Operador de fusión null, se asignará como valor null si $_GET['id_viaje'] no está definido
$idViaje = $_GET['id_viaje'] ?? null;

if ($idViaje) {
    $viaje = $viajeController->obtenerViajePorIdController($idViaje);
    if (!$viaje) {
        // Manejar el caso de que el viaje no se encuentre
        $_SESSION['mensaje'] = "Viaje no encontrado.";
        header("Location: ./TableroDeViajes.php");
        exit;
    }
} else {
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
    <title>Gestión de Viaje - Mytra</title>
</head>
<body>
    
    <h1>Gestión de Viaje: <?php echo htmlspecialchars($viaje['nombre_viaje']); ?></h1>
    
    <div>
        <a href="../Controller/eliminarViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>" onclick="return confirm('¿Estás seguro de querer eliminar este viaje?');">Eliminar este viaje</a>
    </div>
    <div>
        <a href="./TableroDeViajes.php">Volver al Tablero de viajes</a>
    </div>

    <!-- Botón para mostrar el formulario de editar viaje -->
    <button id="btnEditarViaje">Editar Viaje</button>
    <!-- Formulario de edición de viaje, inicialmente oculto -->
    <div id="formularioEditarViaje" style="display:none;">
    <!-- Supongamos que ya tienes los datos del viaje cargados en variables PHP -->
        <form method="POST" action="../Controller/actualizarViaje.php"> <!-- Actualiza esta ruta según tu estructura -->
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

    <!-- Botón para mostrar el formulario de añadir nuevo destino -->
    <button id="btnAnadirDestino">Añadir Nuevo Destino</button>
    <!-- Formulario para añadir nuevo destino, inicialmente oculto -->
    <div id="formularioAnadirDestino" style="display:none;">
        <form method="POST" action="rutaParaCrearDestino.php"> <!-- Actualiza esta ruta según tu estructura -->
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

    <!--Enlace con JavaScript-->
    <script src="../assets/js/gestionViaje.js"></script>
</body>
</html>