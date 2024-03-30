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
    //Cambiar formato de las fechas
    $fechaInicioViaje = date('d/m/Y', strtotime($viaje['fecha_inicio']));
    $fechaFinViaje = date('d/m/Y', strtotime($viaje['fecha_fin']));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/btn.css">
    <link rel="stylesheet" href="../assets/css/tablero-viajes.css">
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Gestión de Viajes - Mytra</title>
</head>
<body style="background: #ececec;">
    <?php include './navbar.php'; ?>

    <div class="wrapper" id="destinos" >
    <!--mensaje exito/error-->
    <?php if (isset($_SESSION['mensaje'])): ?>
            <div id="alert-box" class="alert alert-info text-center"><?php echo $_SESSION['mensaje']; ?></div>
            <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
        <?php endif; ?>


    <div class="container ">
        <div class="row mb-3">
            <div class="col-lg-12">
                <h1 class="display-4 mt-4 mb-2">Gestión de tu viaje: <?php echo htmlspecialchars($viaje['nombre_viaje']); ?></h1>             
            </div>
        </div>
        <div class="row g-1">
            <div class="col mb-4"> 
                <!-- Botón para mostrar el formulario de editar viaje -->
                <button id="btnEditarViaje" class="btn-editar">Editar Viaje</button>
            </div>
            <div class="col-auto mb-4">
                 <!--Botón eliminar viaje-->
                <form method="POST" action="../Controller/EliminarViaje.php" onsubmit="return confirm('¿Estás seguro dequerer eliminar este viaje?');">
                    <input type="hidden" name="id_viaje" value="<?= $viaje['id_viaje']?>">
                    <button type="submit" class="btn-eliminar" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>

    <!--Mostramos la información del viaje actual-->
    <div class="row mb-3 informacion-viaje mb-0">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Información del viaje</h2>
                </div>
                <div class="card-body">
                    <p><strong>Fecha de Inicio:</strong> <?php echo $fechaInicioViaje; ?></p>
                    <p><strong>Fecha de Fin:</strong> <?php echo $fechaFinViaje; ?></p>
                    <p><strong>Presupuesto Total:</strong> <?php echo htmlspecialchars($viaje['presupuesto_total']); ?>€</p>
                </div>
            </div>
        </div>
    </div> 
   
        <!-- Formulario de edición de viaje, inicialmente oculto -->
    <div id="formularioEditarViaje" class="container mt-3" style="display:none;">
         <form method="POST" class="row g-3" action="../Controller/ActualizarViaje.php"> <!-- Actualiza esta ruta según tu estructura -->
            <input type="hidden" name="id_viaje" value="<?php echo htmlspecialchars($viaje['id_viaje']); ?>"> <!--Campo invisible para el usuario-->

             <div class="col-md-6 mb-1 mt-1">
                 <label for="nombre_viaje" class="form-label">Nombre del Viaje:</label>
                <input type="text" class="form-control" id="nombre_viaje" name="nombre_viaje" value="<?php echo htmlspecialchars($viaje['nombre_viaje']); ?>" required>
            </div>

             <div class="col-md-3 mb-1 mt-1">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($viaje['fecha_inicio']); ?>" required>
            </div>

            <div class="col-md-3 mb-1 mt-1">
                <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($viaje['fecha_fin']); ?>" required>
            </div>

            <div class="col-md-12 mb-1 mt-1">
                <label for="presupuesto_total" class="form-label">Presupuesto Total:</label>
                <input type="number" class="form-control" id="presupuesto_total" name="presupuesto_total" value="<?php echo htmlspecialchars($viaje['presupuesto_total']); ?>" required step="0.01">
            </div>

            <div class="col-6 mb-1 mt-1">
                 <input type="submit" class="btn-primary" value="Actualizar Viaje">
             </div>
         </form>
     </div>
    
    <br><br><hr>

    <div class="container mt-3">
    <div class="row align-items-center mb-3">
        <!-- Coloca el texto "Destinos" primero -->
        <div class="col">
            <h2 class="display-6">Destinos</h2>
        </div>
        <!-- Coloca el botón después, sin un tamaño de columna fijo para que ocupe el espacio restante -->
        <div class="col-auto">
            <!-- Botón para mostrar el formulario de añadir nuevo destino -->
            <button id="btnAnadirDestino" class="btn-editar" style="display:block;">
                <i class="fas fa-plus"></i>
            </button>
            <button id="btnAnadirDestinoCancel" class="btn-editar" style="display:none;">Cancelar</button>
        </div>
    </div>
            <!-- Formulario para añadir nuevo destino, inicialmente oculto -->
    <div id="formularioAnadirDestino" class="container" style="display:none;">
        <form method="POST" class="row g-3" action="../Controller/CrearDestino.php"> <!-- Actualiza esta ruta según tu estructura -->
            <input type="hidden" name="id_viaje" value="<?php echo $idViaje; ?>"> <!--Campo invisible para el usuario-->

            <div class="col-md-6">
                <label for="nombre_destino" class="form-label">Nombre del Destino:</label>
                <input type="text" class="form-control" id="nombre_destino" name="nombre_destino" required>
            </div>

            <div class="col-md-3">
                <label for="fecha_inicio_destino" class="form-label">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio_destino" name="fecha_inicio" required>
            </div>

            <div class="col-md-3">
                <label for="fecha_fin_destino" class="form-label">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fecha_fin_destino" name="fecha_fin" required>
            </div>
            
            <div class="col-6">
                <input type="submit" class="btn-primary mb-4" value="Añadir Destino">
            </div>
        </form>
    </div>

    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!--Tarjetas de destinos-->
    <?php if (!empty($destinos)): ?>
        <?php foreach ($destinos as $destino): 
            $fechaInicioDestino = date('d/m/Y', strtotime($destino['fecha_inicio']));
            $fechaFinDestino = date('d/m/Y', strtotime($destino['fecha_fin']));        
        ?>
            <div class="col">
                <div class="card h-100 custom-card destinos-container">
                  <div class="card-body destino-card">        
                        <div class="card-title destino" onclick="window.location.href='gestionActividades.php?id_destino=<?php echo $destino['id_destino']; ?>&id_viaje=<?=$idViaje?>';">
                            <h3 class="titulo-card"><?= htmlspecialchars($destino['nombre_destino'])?></h3>
                        </div>
                        <div class="card-content">
                            <div class="card-text fecha-info">
                            <p class="card-text">Desde: <?= htmlspecialchars($fechaInicioDestino)?></p>
                            <p class="card-text">Hasta: <?= htmlspecialchars($fechaFinDestino)?></p>
                            </div>
                            <div class="card-footer destino-card-buttons">
                                <!--Botón editar destino, pasamos a través del boton todos los parámetros del destino-->
                                <button type="button" class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#editDestinationModal" 
                                data-id="<?= $destino['id_destino'] ?>"
                                data-nombre="<?= htmlspecialchars($destino['nombre_destino']) ?>"
                                data-fecha-inicio="<?= $destino['fecha_inicio'] ?>"
                                data-fecha-fin="<?= $destino['fecha_fin'] ?>">
                                    Editar
                                </button>
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
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
            <?php else: ?>
                <p>No hay destinos para este viaje</p>
            <?php endif; ?>
    </div>

    <div class="modal fade" id="editDestinationModal" tabindex="-1" aria-labelledby="editDestinationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Header del modal-->
            <div class="modal-header">
                <h5 class="modal-title" id="editDestinationModalLabel">Editar Destino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Formulario dentro de la ventana modal -->
                <form id="editDestinoForm" method="POST" class="row g-3" action="../Controller/ActualizarDestino.php">
                    <input type="hidden" name="id_viaje" value="<?php echo htmlspecialchars($viaje['id_viaje']); ?>">
                    <input type="hidden" name="id_destino" value="<?= $destino['id_destino'] ?>">
                                    
                    <label for="nombre_destino" class="form-label">Nombre del Destino:</label>
                    <input type="text" id="nombre_destino" class="form-control" name="nombre_destino" value="<?= $destino['nombre_destino'] ?>" required>
                                        
                    <label for="fecha_inicio_destino" class="form-label">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio_destino" class="form-control" name="fecha_inicio" value="<?= $destino['fecha_inicio'] ?>" required>
                                        
                    <label for="fecha_fin_destino" class="form-label">Fecha de Fin:</label>
                    <input type="date" id="fecha_fin_destino" class="form-control" name="fecha_fin" value="<?= $destino['fecha_fin'] ?>" required>
                </form>
            </div>
            <!-- Footer del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-eliminar" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="editDestinoForm" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
    </div>
          
</div>
</div>      
</div> 

    <!--Enlaces con JavaScript-->
    <script src="../assets/js/gestionViaje.js"></script>
    <script src="../assets/js/tablero-viajes.js"></script>
    <!--BOOTSTRAP JS-->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>