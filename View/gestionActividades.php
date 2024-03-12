<?php

require_once __DIR__ . '/../controller/DestinoController.php';
require_once __DIR__ . '/../controller/ActividadController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$destinoController = new DestinoController();
$actividadController = new ActividadController();

//Operador de fusión null, se asignará como valor null si $_GET['id_viaje'] no está definido
$idDestino= isset($_GET['id_destino']) ? (int) $_GET['id_destino'] : null;
 
if ($idDestino) {
    $destino = $destinoController->obtenerDestinoPorIdController($idDestino);
    $actividades = $actividadController->obtenerActividadesPorDestinoController($idDestino);

    //Debug para ver el array que nos devuelve $actividades 
    // echo '<pre>'; // Etiqueta <pre> para una mejor legibilidad en el navegador
    // print_r($actividades);
    // echo '</pre>';

   
} else {
    $_SESSION['mensaje'] = "No se ha especificado el destino.";
    // Redirigir si no se proporciona id_viaje
    header("Location: ./gestionViaje.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Gestión de actividades - Mytra</title>
</head>
<body>
<div class="informacion-destino">
        <h2>Información de <?php echo htmlspecialchars($destino['nombre_destino']); ?></h2>
        <strong>Fecha de Inicio:</strong> <?php echo htmlspecialchars($destino['fecha_inicio']); ?>
        <strong>     Fecha de Fin:</strong> <?php echo htmlspecialchars($destino['fecha_fin']); ?></p>
</div>
<br><hr>
<h2>Actividades planeadas</h2>
<table class="tabla-actividades">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Duración</th>
            <th>Precio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($actividades as $actividad) : ?>
            <tr>
                <td><b><?php echo htmlspecialchars($actividad['nombre_actividad'])?></b></td>
                <td><?php echo htmlspecialchars($actividad['descripcion'])?></td>
                <td><?php echo htmlspecialchars($actividad['fecha'])?></td>
                <td><?php echo htmlspecialchars($actividad['duracion'])?></td>
                <td><?php echo htmlspecialchars($actividad['Precio'])?></td>
                <td>
                <!-- Botones de editar y eliminar -->
                <a href="../Controller/ActualizarActividad.php?id_actividad=<?= $actividad['id_actividad'] ?>" class="btn-editar-act">Editar</a>
                <a href="../Controller/EliminarActividad.php?id_actividad=<?= $actividad['id_actividad'] ?>" class="btn-eliminar-act" onclick="return confirm('¿Estás seguro de querer eliminar esta actividad?');">Eliminar</a>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div>
        <a href="./gestionViaje.php">Volver a mis destinos</a>
    </div>
</body>
</html>