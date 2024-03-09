<?php

require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once __DIR__ . '/../controller/UsuarioController.php';

// Verificar la sesión del usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$usuario = $_SESSION['usuario'];
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

   <!-- Formulario para crear un nuevo viaje -->
<h2>Crear un nuevo viaje</h2>
<form method="POST" action="crear_viaje.php">
    <label for="nombre_viaje">Nombre del Viaje:</label>
    <input type="text" name="nombre_viaje" id="nombre_viaje" required><br><br>

    <label for="destino">Destino:</label>
    <input type="text" name="destino" id="destino" required><br><br>

    <label for="fecha_inicio">Fecha de Inicio:</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio" required><br><br>

    <label for="fecha_fin">Fecha de Fin:</label>
    <input type="date" name="fecha_fin" id="fecha_fin" required><br><br>

    <label for="presupuesto_total">Presupuesto Total:</label>
    <input type="number" name="presupuesto_total" id="presupuesto_total" step="0.01" required><br><br>

    <input type="submit" name="crear_viaje" value="Crear Viaje">
</form>


    
    <!-- Enlaces para cerrar sesión -->

    <a href="../index.php?cerrarSesion=true">Cerrar Sesión</a>
    <a href="./MiPerfil.php">Mi Perfil</a>
   
</body>
</html>