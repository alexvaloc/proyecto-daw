<?php

require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once __DIR__ . '/../controller/UsuarioController.php';

// Crear una instancia del controlador de usuario
$usuarioController = new UsuarioController();

// Verificar la sesión del usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Llamamos al controlador
    $respuesta = $usuarioController->actualizarUsuarioController($_SESSION['id_usuario'], $_POST['nombre'], $_POST['email'], $_POST['contraseña'], $_POST['confirmar_contraseña']);
    
    if($respuesta === true){
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['email'] = $_POST['email'];

        echo "Perfil actualizado correctamente";
    }else{
    //Mostramos mensaje de error desde el modelo
    echo $respuesta;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
</head>
<body>
    <!-- Formulario para editar perfil -->
<h2>Editar perfil</h2>
<form method="POST" action="MiPerfil.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $_SESSION['nombre'] ?>" required><br><br>
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required><br><br>
    <label for="contraseña">Nueva Contraseña:</label>
    <input type="password" name="contraseña" id="contraseña" placeholder="Ingresa nueva contraseña"><br><br>
    <label for="confirmar_contraseña">Confirmar Nueva Contraseña:</label>
    <input type="password" name="confirmar_contraseña" id="confirmar_contraseña" placeholder="Confirma nueva contraseña"><br><br>
    <input type="submit" name="editar_perfil" value="Guardar Cambios">
</form>

<a href="./TableroDeViajes.php">Tablero de viajes</a>
</body>
</html>