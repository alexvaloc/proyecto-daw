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

    $fechaInicioDestino = date('d/m/Y', strtotime($destino['fecha_inicio']));
    $fechaFinDestino = date('d/m/Y', strtotime($destino['fecha_fin']));
   
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
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--CSS general-->
    <link rel="stylesheet" href="../assets/css/btn.css">
    <!--CSS Específico de página-->
    <link rel="stylesheet" href="../assets/css/gestionActividades.css">
    <title>Gestión de actividades - Mytra</title>
</head>
<body style="background: #ececec;">

<?php include './navbar.php'; ?>

    <!--mensaje exito/error-->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div id="alert-box" class="alert alert-info text-center"><?php echo $_SESSION['mensaje']; ?></div>
            <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
        <?php endif; ?>

<div class="container">
    <!--Mostramos la información del viaje actual-->
    <div class="row mb-3 informacion-viaje mb-0 mt-4">
        <div class="col text-center">
            <div class="card">
                <div class="card-header my-3">
                <h2 class="display-5">Información de <?php echo htmlspecialchars($destino['nombre_destino']); ?></h2>
                </div>
                <div class="card-body">
                <span><strong>Fecha de Inicio:</strong> <?php echo $fechaInicioDestino; ?></span>
                <span><strong>   Fecha de Fin:</strong> <?php echo $fechaFinDestino ?></span>
                </div>
            </div>
        </div>
    </div> 


<br><hr>

    <div class="row mb-3" style="background: #376d6f;">
        <div class="col text-center">
            <h2 class="display-5 mt-2 mb-2" style="color: #f5f5f5;">Actividades planeadas</h2>
        </div>
    </div>
<!--Botón para añadir nuevas actividades-->
<div class="card">
    <div class="card-body">
    <h3 class="card-title">Crear nueva actividad</h3>
    <form action="../Controller/CrearActividad.php" class="row g-3" method='POST'>
        <input type="hidden" name="id_destino" value="<?php echo $idDestino;?>" required>
        
        <div class="col-md-6">
            <label for="nombre_actividad" class="form-label">Nombre de la actividad:</label>
            <input type="text" id="nombre_actividad" class="form-control" name="nombre_actividad" required>
        </div>

        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
        </div> 

        <div class="col-md-4">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>               

        <div class="col-md-4">
            <label for="duracion" class="form-label">Duración (HH:MM):</label>
            <input type="time" class="form-control" id="duracion" name="duracion" required>
        </div>

        <div class="col-md-4">
            <label for="Precio" class="form-label">Precio (€):</label>
            <input type="number" class="form-control" id="Precio" name="Precio" step="0.01" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn-primary mb-4">Añadir a la tabla</button>
        </div>

    </form>
    </div>
</div>
<div class="container" style="background: #16b3a623;">
    <table class="table table-striped table-hover table-bordered mt-3 tabla-actividades">
        <thead class="thead-dark text-center" id="cabecera" >
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Duración</th>
                <th>Precio</th>
                <th style="min-width: 70px;"></th> <!--Ancho mínimo de columna para evitar que se superpongan los botones-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actividades as $actividad) : 
                $fechaActividadFormateada = date('d/m/Y', strtotime($actividad['fecha']));    
            ?>
                <tr>
                    <td><b><?php echo htmlspecialchars($actividad['nombre_actividad'])?></b></td>
                    <td><?php echo htmlspecialchars($actividad['descripcion'])?></td>
                    <td><?php echo $fechaActividadFormateada; ?></td>
                    <td><?php echo htmlspecialchars($actividad['duracion'])?></td>
                    <td><?php echo htmlspecialchars($actividad['Precio'])?>€</td>
                    <td>
                    <!-- Botones de editar y eliminar -->
                    <button class="btn-editar-act btn-editar mb-2"
                    data-id-actividad="<?= $actividad['id_actividad'] ?>"
                    data-nombre="<?= htmlspecialchars($actividad['nombre_actividad'])?>"
                    data-descripcion="<?= htmlspecialchars($actividad['descripcion'])?>"
                    data-fecha="<?=htmlspecialchars($actividad['fecha']) ?>"
                    data-duracion="<?=htmlspecialchars($actividad['duracion'])?>"
                    data-precio="<?=htmlspecialchars($actividad['Precio']) ?>" >
                    <i class="fas fa-edit"></i>
                    </button>
                    <a href="../Controller/EliminarActividad.php?id_actividad=<?= $actividad['id_actividad'] ?>&id_destino=<?= $idDestino?>" class="btn-eliminar-act btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar esta actividad?');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>

    <!--Formulario de edición de actividades-->
    
        <div class="container">
        <div id="formularioEditarActividad" class="container mt-3" style="display:none;">
            <form  method="POST" class="row g-3" action="../Controller/ActualizarActividad.php">
                <input type="hidden" name="id_actividad" value="<?php echo htmlspecialchars($actividad['id_actividad']);?>">
                <input type="hidden" name="id_destino" value="<?php echo $idDestino; ?>">

                <div class="col-md-12 my-2">
                <label for="nombre_actividad" class="form-label">Nombre de la actividad:</label>
                <input type="text" class="form-control" id="nombre_actividad" name="nombre_actividad" value="<?php echo htmlspecialchars($actividad['nombre_actividad']);?>" required>
                </div>

                <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($actividad['fecha']);?>"required>
                </div>

                <div class="col-md-6">
                <label for="duracion" class="form-label">Duración (HH:MM):</label>
                <input type="time" class="form-control" id="duracion" name="duracion" value="<?php echo htmlspecialchars($actividad['duracion']);?>" required>
                </div>

                <div class="col-md-6">
                <label for="Precio" class="form-label">Precio (€):</label>
                <input type="number" class="form-control" id="Precio" name="Precio" step="0.01" value="<?php echo htmlspecialchars($actividad['Precio']);?>" required>
                </div>

                <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="4"><?php echo htmlspecialchars($actividad['descripcion']);?></textarea>
                </div>

                <div class="col-10">
                <button type="submit" class="btn-primary mb-4">Guardar cambios</button>   
                </div>
                <div class="col-2">
                <button type="button" class="btn-editar" id="btnCerrarFormularioAct">Cerrar</button>
                </div>
            </form>
        </div>
        </div>
        
        
</div>

    <div class="container total-precios my-4 py-3">
        <h3 class="total-precio-texto text-center">Total de Precios de Actividades: 
            <span class="precio-cifra">€<?php echo htmlspecialchars($totalPrecios); ?></span>
        </h3>
    
        <div class="text-center">
            <a href="./gestionViaje.php?id_viaje=<?= $idViaje ?>&id_destino=<?= $idDestino ?>" class="input-tablero">Volver a mis destinos</a>
        </div>
    </div>

</div>
    <!--Enlaces con JavaScript-->
    <script src="../assets/js/gestionActividades.js"></script>
    <script src="../assets/js/tablero-viajes.js"></script>
    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>