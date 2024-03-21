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
$idViaje= isset($_GET['id_viaje']) ? (int) $_GET['id_viaje'] : null;
 
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

$totalPrecios = $actividadController->calcularTotalPrecioPorDestinoController($idDestino);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/gestionActividades.css">
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Gestión de actividades - Mytra</title>
</head>
<body>
<!-- mensaje de exito o error al crear/editar/eliminar -->
<?php if (isset($_SESSION['mensaje'])) {
        echo "<p>" . $_SESSION['mensaje'] . "</p>";
        unset($_SESSION['mensaje']); // Borra el mensaje después de mostrarlo
    }
    ?>

<div class="informacion-destino">
        <h2>Información de <?php echo htmlspecialchars($destino['nombre_destino']); ?></h2>
        <strong>Fecha de Inicio:</strong> <?php echo htmlspecialchars($destino['fecha_inicio']); ?>
        <strong>     Fecha de Fin:</strong> <?php echo htmlspecialchars($destino['fecha_fin']); ?></p>
</div>
<br><hr>
<h2>Actividades planeadas</h2>
<!--Botón para añadir nuevas actividades-->
<div class="crear-actividad">
    <h3>Crear nueva actividad</h3>
    <form action="../Controller/CrearActividad.php" method='POST'>
        <input type="hidden" name="id_destino" value="<?php echo $idDestino;?>" required>
        
        <div class="form-group">
            <label for="nombre_actividad">Nombre de la actividad:</label>
            <input type="text" id="nombre_actividad" name="nombre_actividad" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>

        <div class="form-group">
            <label for="duracion">Duración (HH:MM):</label>
            <input type="time" id="duracion" name="duracion" required>
        </div>

        <div class="form-group">
            <label for="Precio">Precio (€):</label>
            <input type="number" id="Precio" name="Precio" step="0.01" required>
        </div>

        <button type="submit" class="btn-crear-actividad">Añadir a la tabla</button>
    </form>

</div>
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
                <td><?php echo htmlspecialchars($actividad['Precio'])?>€</td>
                <td>
                <!-- Botones de editar y eliminar -->
                <button class="btn-editar-act"
                data-id-actividad="<?= $actividad['id_actividad'] ?>"
                data-nombre="<?= htmlspecialchars($actividad['nombre_actividad'])?>"
                data-descripcion="<?= htmlspecialchars($actividad['descripcion'])?>"
                data-fecha="<?=htmlspecialchars($actividad['fecha']) ?>"
                data-duracion="<?=htmlspecialchars($actividad['duracion'])?>"
                data-precio="<?=htmlspecialchars($actividad['Precio']) ?>" >
                <i class="fas fa-edit"></i>
                </button>
                <a href="../Controller/EliminarActividad.php?id_actividad=<?= $actividad['id_actividad'] ?>&id_destino=<?= $idDestino?>" class="btn-eliminar-act" onclick="return confirm('¿Estás seguro de querer eliminar esta actividad?');">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <!--Formulario de edición de actividades-->
    <div id="formularioEditarActividad" style="display:none;">
        <form  method="POST" action="../Controller/ActualizarActividad.php">
            <input type="hidden" name="id_actividad" value="<?php echo htmlspecialchars($actividad['id_actividad']);?>">
            <input type="hidden" name="id_destino" value="<?php echo $idDestino; ?>">

            <label for="nombre_actividad">Nombre de la actividad:</label>
            <input type="text" id="nombre_actividad" name="nombre_actividad" value="<?php echo htmlspecialchars($actividad['nombre_actividad']);?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4"><?php echo htmlspecialchars($actividad['descripcion']);?></textarea>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($actividad['fecha']);?>"required>

            <label for="duracion">Duración (HH:MM):</label>
            <input type="time" id="duracion" name="duracion" value="<?php echo htmlspecialchars($actividad['duracion']);?>" required>

            <label for="Precio">Precio (€):</label>
            <input type="number" id="Precio" name="Precio" step="0.01" value="<?php echo htmlspecialchars($actividad['Precio']);?>" required>

            <button type="submit" class="btn-crear-actividad">Guardar cambios</button>   
            <button type="button" id="btnCerrarFormularioAct">Cerrar</button>
        </form>

    </div>
</table>
<div class="total-precios">
    <h3>Total de Precios de Actividades: €<?php echo htmlspecialchars($totalPrecios); ?></h3>
</div>
<div>
    <a href="./gestionViaje.php?id_viaje=<?= $idViaje ?>&id_destino=<?= $idDestino ?>">Volver a mis destinos</a>
</div>
    <!--Enlace con JavaScript-->
    <script src="../assets/js/gestionActividades.js"></script>
    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>