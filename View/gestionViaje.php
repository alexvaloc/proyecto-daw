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
        <a href="editarViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>">Editar mi viaje</a>
    </div>
    <div>
        <a href="crearDestino.php?id_viaje=<?php echo $viaje['id_viaje']; ?>">Crear nuevo destino</a>
    </div>
    <div>
        <a href="../Controller/eliminarViaje.php?id_viaje=<?php echo $viaje['id_viaje']; ?>" onclick="return confirm('¿Estás seguro de querer eliminar este viaje?');">Eliminar este viaje</a>
    </div>
    <div>
        <a href="./TableroDeViajes.php">Tablero de viajes</a>
    </div>
   
</body>
</html>