<?php

require_once "../Entities/Usuario.php";
require_once "../Controller/UsuarioController.php";
require_once "../Model/UsuarioModel.php";

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

    <!-- Formulario para crear un viaje -->
    <h2>Crear un nuevo viaje</h2>
    <form method="POST" action="crear_viaje.php">
        <label for="destino">Destino:</label>
        <input type="text" name="destino" required><br><br>
        <label for="fecha_salida">Fecha de salida:</label>
        <input type="date" name="fecha_salida" required><br><br>
        <!-- Agregar más campos según sea necesario -->
        <input type="submit" name="crear_viaje" value="Crear Viaje">
    </form>

    <!-- Formulario para editar perfil -->
    <h2>Editar perfil</h2>
    <form method="POST" action="editar_perfil.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="" required><br><br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" value="" required><br><br>
        <!-- Agregar más campos según sea necesario -->
        <input type="submit" name="editar_perfil" value="Guardar Cambios">
    </form>

    <!-- Enlaces para cerrar sesión -->

    <a href="../index.php?cerrarSesion=true">Cerrar Sesión</a>
   
</body>
</html>